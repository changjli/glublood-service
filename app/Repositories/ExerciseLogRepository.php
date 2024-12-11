<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ExerciseLogRepository
{
    public function getExerciseLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
        WITH date_range AS (
            SELECT generate_series(?::date, ?::date, interval '1 day') AS \"date\"
        )
        SELECT
            TO_CHAR(dr.\"date\", 'YYYY-MM-DD') as date,
            COALESCE(AVG(el.burned_calories), 0) AS avg_burned_calories,
            COUNT(el.id) AS log_count
        FROM date_range dr
        LEFT JOIN exercise_logs el ON el.\"date\" = dr.\"date\" AND el.user_id = ?
        GROUP BY dr.\"date\"
        ORDER BY dr.\"date\" ASC;
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId
        ]);
    }

    public function getExerciseLogReportByMonthRepo(int $userId, int $month, int $year)
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
            TO_CHAR(w.week_start, 'YYYY-MM-DD') || '~' ||
            TO_CHAR(w.week_start + INTERVAL '6 days', 'YYYY-MM-DD') AS week_range,
            COALESCE(AVG(el.burned_calories), 0) AS avg_burned_calories,
            COUNT(el.id) as log_count
        FROM
            weeks w
        LEFT JOIN
            exercise_logs el ON el.\"date\" >= w.week_start
                        AND el.\"date\" < w.week_start + INTERVAL '7 days'
                        AND el.user_id = ?
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

    public function getExerciseLogReportByYearRepo(int $userId, int $year)
    {
        $query = "
        WITH months AS (
            SELECT generate_series(1, 12) AS month_number
        ) SELECT
        TO_CHAR(DATE_TRUNC('month', DATE_TRUNC('year', CURRENT_DATE) + (m.month_number - 1) * INTERVAL '1 month'), 'Month') AS month,
        COALESCE(AVG(el.burned_calories), 0) as avg_burned_calories,
        COUNT(el.id) as log_count
        FROM months m
        LEFT JOIN exercise_logs el
        ON EXTRACT (MONTH FROM el.\"date\") = m.month_number
        WHERE (el.user_id = ? AND EXTRACT (YEAR FROM el.\"date\") = ?)
        OR el.id IS NULL
        GROUP BY m.month_number
        ORDER BY m.month_number DESC;
        ";

        return DB::select($query, [
            $userId,
            $year,
        ]);
    }
}
