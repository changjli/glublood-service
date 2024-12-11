<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogReportRepository
{
    public function getFoodLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
        SELECT
            fl.\"date\" ,
            mt.description ,
            COALESCE (avg(fl.calories), 0) AS avg_calories
        FROM food_logs fl
        LEFT JOIN master_timings mt ON fl.\"time\" >= mt.start_time AND fl.\"time\" <= mt.end_time
        WHERE fl.\"date\" >= ?
        AND fl.\"date\" <= ?
        AND fl.user_id = ?
        GROUP BY fl.\"date\" , mt.description
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId,
        ]);
    }

    public function getExerciseLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
       SELECT
            el.\"date\" ,
            mt.description ,
            COALESCE (avg(el.burned_calories), 0) AS avg_burned_calories
        FROM exercise_logs el
        LEFT JOIN master_timings mt ON el.start_time >= mt.start_time AND el.start_time <= mt.end_time
        WHERE el.\"date\" >= ?
        AND el.\"date\" <= ?
        AND el.user_id = ?
        GROUP BY el.\"date\" , mt.description
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId,
        ]);
    }

    public function getGlucoseLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
        SELECT
            gl.\"date\" ,
            mt.description ,
            COALESCE (avg(gl.glucose_rate), 0) AS avg_glucose_rate
        FROM glucose_logs gl
        LEFT JOIN master_timings mt ON gl.\"time\"::time >= mt.start_time AND gl.\"time\"::time <= mt.end_time
        WHERE gl.\"date\" >= ?
        AND gl.\"date\" <= ?
        AND gl.user_id = ?
        GROUP BY gl.\"date\" , mt.description
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId,
        ]);
    }

    public function getMedicineLogReportByDateRepo(int $userId, string $startDate, string $endDate)
    {
        $query = "
        SELECT
            m.\"date\" ,
            mt.description ,
            string_agg(concat(m.amount, ' ', m.\"type\", ' ', m.\"name\") , ' + ') as medicine
        FROM medicines m
        LEFT JOIN master_timings mt ON m.\"time\"::time >= mt.start_time AND m.\"time\"::time <= mt.end_time
        WHERE m.\"date\" >= ?
        AND m.\"date\" <= ?
        AND m.user_id = ?
        GROUP BY m.\"date\" , mt.description
        ";

        return DB::select($query, [
            $startDate,
            $endDate,
            $userId,
        ]);
    }

    public function getAllLogReportByDateRepo(
        int $userId,
        string $startDate,
        string $endDate,
        $includeFoodLog,
        $includeExerciseLog,
        $includeGlucoseLog,
        $includeMedicineLog
    ) {
        $query = "WITH date_range AS (
            SELECT generate_series(?::date, ?::date, interval '1 day') AS \"date\"
        )";
        $params = [$startDate, $endDate];

        $selects = [
            'TO_CHAR(dr."date", \'YYYY-MM-DD\') as date',
            'mt.description'
        ];

        if ($includeFoodLog) {
            $selects[] = 'COALESCE(AVG(fl.calories), 0) AS avg_calories';
        }
        if ($includeExerciseLog) {
            $selects[] = 'COALESCE(AVG(el.burned_calories), 0) AS avg_burned_calories';
        }
        if ($includeGlucoseLog) {
            $selects[] = 'COALESCE(AVG(gl.glucose_rate), 0) AS avg_glucose_rate';
        }
        if ($includeMedicineLog) {
            $selects[] = 'string_agg(DISTINCT CONCAT(m.amount, \' \', m."type", \' \', m."name"), \' + \') AS medicine_details';
        }

        $query .= "SELECT " . implode(', ', $selects);

        $query .= " FROM date_range dr CROSS JOIN master_timings mt ";

        if ($includeFoodLog) {
            $query .= "LEFT JOIN food_logs fl ON fl.\"date\" = dr.\"date\"
                AND (
                    CASE
                        WHEN mt.start_time <= mt.end_time THEN
                            fl.\"time\" >= mt.start_time AND fl.\"time\" <= mt.end_time
                        ELSE
                            fl.\"time\" >= mt.start_time OR fl.\"time\" <= mt.end_time
                    END
                )
                AND fl.user_id = ? ";
            $params[] = $userId;
        }

        if ($includeExerciseLog) {
            $query .= "LEFT JOIN exercise_logs el ON el.\"date\" = dr.\"date\"
                AND (
                    CASE
                        WHEN mt.start_time <= mt.end_time THEN
                            el.\"start_time\" >= mt.start_time AND el.\"start_time\" <= mt.end_time
                        ELSE
                            el.\"start_time\" >= mt.start_time OR el.\"start_time\" <= mt.end_time
                    END
                )
                AND el.user_id = ? ";
            $params[] = $userId;
        }
        if ($includeGlucoseLog) {
            $query .= "LEFT JOIN glucose_logs gl ON gl.\"date\" = dr.\"date\"
                AND (
                    CASE
                        WHEN mt.start_time <= mt.end_time THEN
                            gl.\"time\" >= mt.start_time AND gl.\"time\" <= mt.end_time
                        ELSE
                            gl.\"time\" >= mt.start_time OR gl.\"time\" <= mt.end_time
                    END
                )
                AND gl.user_id = ? ";
            $params[] = $userId;
        }
        if ($includeMedicineLog) {
            $query .= "LEFT JOIN medicines m ON m.\"date\" = dr.\"date\"
                AND (
                    CASE
                        WHEN mt.start_time <= mt.end_time THEN
                            m.\"time\" >= mt.start_time AND m.\"time\" <= mt.end_time
                        ELSE
                            m.\"time\" >= mt.start_time OR m.\"time\" <= mt.end_time
                    END
                )
                AND m.user_id = ? ";
            $params[] = $userId;
        }

        // $query .= "WHERE fl.\"date\" >= ? AND fl.\"date\" <= ? AND fl.user_id = ? ";

        $query .= "GROUP BY dr.\"date\", mt.description, mt.sequence ORDER BY dr.\"date\", mt.sequence;";

        return DB::select($query, $params);
    }
}
