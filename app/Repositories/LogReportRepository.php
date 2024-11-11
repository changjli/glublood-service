<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

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
}
