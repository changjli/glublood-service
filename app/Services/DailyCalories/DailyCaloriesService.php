<?php

namespace App\Services\DailyCalories;

use App\Models\DailyCalories;
use Illuminate\Support\Facades\Auth;

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

        return DailyCalories::updateOrCreate([
            'date' => $data['date'],
            'user_id' => $data['user_id'],
        ], $data);
    }

    public function updateConsumedCalories($date, $calories)
    {
        $user = Auth::user();

        $dailyCalories = DailyCalories::where('user_id', $user->id)
            ->where('date', $date)
            ->first();
        $dailyCalories->consumed_calories = $dailyCalories->consumed_calories + $calories;
        return $dailyCalories->save();
    }
}
