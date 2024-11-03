<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FoodLogRepository
{
    public function getFoodLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = '
        SELECT
            fl."date" ,
            AVG(fl.calories) as avg_calories
        FROM food_logs fl
        WHERE fl.user_id = ?
            AND fl."date" >= ?
            AND fl."date" <= ?
        GROUP BY fl."date"
        ORDER BY fl."date" DESC
        ';

        return DB::select($query, [
            $userId,
            $startDate,
            $endDate,
        ]);
    }

    public function getFoodLogReportByMonthRepo(int $userId, int $month, int $year)
    {
        $query = "
        WITH month_range AS (
            SELECT
                DATE_TRUNC('month', DATE_TRUNC('year', make_date(?, 1, 1)) + INTERVAL '1 month' * (? - 1)) AS start_date,
                (DATE_TRUNC('month', DATE_TRUNC('year', make_date(?, 1, 1)) + INTERVAL '1 month' * ?) - INTERVAL '1 day') AS end_date
        ),
        first_monday AS (
            SELECT
                start_date + ((1 - EXTRACT(DOW FROM start_date)) % 7) * INTERVAL '1 day' AS week_start
            FROM
                month_range
        ),
        weeks AS (
            SELECT
                generate_series(week_start, end_date, '7 days') AS week_start
            FROM
                month_range, first_monday
        )
        SELECT
            TO_CHAR(w.week_start, 'YYYY-MM-DD') || ' - ' ||
            TO_CHAR(w.week_start + INTERVAL '6 days', 'YYYY-MM-DD') AS week_range,
            COALESCE(AVG(fl.calories), 0) AS avg_calories
        FROM
            weeks w
        LEFT JOIN
            food_logs fl ON fl.\"date\" >= w.week_start
                        AND fl.\"date\" < w.week_start + INTERVAL '7 days'
                        AND fl.user_id = ?
        GROUP BY
            w.week_start
        ORDER BY
            w.week_start
        ";

        return DB::select($query, [
            $year,
            $month,
            $year,
            $month,
            $userId,
        ]);
    }

    public function getFoodLogReportByYearRepo(int $userId, int $year)
    {
        $query = "
        WITH months AS (
            SELECT generate_series(1, 12) AS month_number
        ) SELECT
        TO_CHAR(DATE_TRUNC('month', DATE_TRUNC('year', CURRENT_DATE) + (m.month_number - 1) * INTERVAL '1 month'), 'Month') AS month,
        COALESCE(AVG(fl.calories), 0) as avg_calories
        FROM months m
        LEFT JOIN food_logs fl
        ON EXTRACT (MONTH FROM fl.\"date\") = m.month_number
        WHERE (fl.user_id = ? AND EXTRACT (YEAR FROM fl.\"date\") = ?)
        OR fl.id IS NULL
        GROUP BY m.month_number
        ORDER BY m.month_number DESC;
        ";

        return DB::select($query, [
            $userId,
            $year,
        ]);
    }
}
