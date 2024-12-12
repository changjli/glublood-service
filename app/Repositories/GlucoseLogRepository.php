<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class GlucoseLogRepository
{
    public function getGlucoseLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
        WITH date_range AS (
            SELECT generate_series(?::date, ?::date, interval '1 day') AS \"date\"
        )
        SELECT
            TO_CHAR(dr.\"date\", 'YYYY-MM-DD') as date,
            COALESCE(AVG(gl.glucose_rate), 0) AS avg_glucose_rate,
            COUNT(gl.id) AS log_count
        FROM date_range dr
        LEFT JOIN glucose_logs gl ON gl.\"date\" = dr.\"date\" AND gl.user_id = ?
        GROUP BY dr.\"date\"
        ORDER BY dr.\"date\" ASC;
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId
        ]);
    }

    public function getGlucoseLogReportByMonthRepo(int $userId, int $month, int $year)
    {
        $query = "
        WITH month_range AS (
            SELECT
                DATE_TRUNC('month', DATE_TRUNC('year', make_date(?, 1, 1)) + INTERVAL '1 month' * (? - 1)) AS start_date,
                (DATE_TRUNC('month', DATE_TRUNC('year', make_date(?, 1, 1)) + INTERVAL '1 month' * ?) - INTERVAL '1 day') AS end_date
        ),
        first_monday AS (
            SELECT
                start_date + CAST(((1 - EXTRACT(DOW FROM start_date)) AS INT) % 7) * INTERVAL '1 day' AS week_start
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
            COALESCE(AVG(gl.glucose_rate), 0) AS avg_glucose_rate,
            COUNT(gl.id) as log_count
        FROM
            weeks w
        LEFT JOIN
            glucose_logs gl ON gl.\"date\" >= w.week_start
                        AND gl.\"date\" < w.week_start + INTERVAL '7 days'
                        AND gl.user_id = ?
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

    public function getGlucoseLogReportByYearRepo(int $userId, int $year)
    {
        $query = "
        WITH months AS (
            SELECT generate_series(1, 12) AS month_number
        ) SELECT
        TO_CHAR(DATE_TRUNC('month', DATE_TRUNC('year', CURRENT_DATE) + (m.month_number - 1) * INTERVAL '1 month'), 'Month') AS month,
        COALESCE(AVG(gl.glucose_rate), 0) as avg_glucose_rate,
        COUNT(gl.id) as log_count
        FROM months m
        LEFT JOIN glucose_logs gl
        ON EXTRACT (MONTH FROM gl.\"date\") = m.month_number
        WHERE (gl.user_id = ? AND EXTRACT (YEAR FROM gl.\"date\") = ?)
        OR gl.id IS NULL
        GROUP BY m.month_number
        ORDER BY m.month_number DESC;
        ";

        return DB::select($query, [
            $userId,
            $year,
        ]);
    }
}
