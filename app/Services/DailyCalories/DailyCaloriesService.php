<?php

namespace App\Services\DailyCalories;

use App\Models\DailyCalories;
use App\Models\ExerciseLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyCaloriesService implements DailyCaloriesServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getByDate($date)
    {
        $user = Auth::user();

        $data = DailyCalories::where('user_id', $user->id)
            ->where('date', $date)
            ->firstOrFail();

        return $data;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        $dailyCalories = DailyCalories::where('user_id', $user->id)
            ->where('date', $data['date'])
            ->first();

        if ($dailyCalories) {
            $dailyCalories->target_calories = $data['target_calories'];
            $dailyCalories->save();
        } else {
            DailyCalories::create($data);
        }

        return;
    }

    public function updateConsumedCalories($date, $calories)
    {
        $user = Auth::user();

        $dailyCalories = DailyCalories::where('user_id', $user->id)
            ->where('date', $date)
            ->first();

        if ($dailyCalories) {
            $dailyCalories->consumed_calories = $dailyCalories->consumed_calories + $calories;
            $dailyCalories->save();
        } else {
            DailyCalories::create([
                'date' => $date,
                'user_id' => $user->id,
                'consumed_calories' => $calories,
                'target_calories' => 0,
            ]);
        }


        return;
    }

    public function getBurnedCaloriesByDateService($date)
    {
        $user = Auth::user();

        $data = ExerciseLog::select(DB::raw('COALESCE(AVG(burned_calories), 0) as avg_burned_calories'))
            ->where('user_id', $user->id)
            ->where('date', $date)
            // ->groupBy('date')
            ->first();

        return $data;
    }
}
