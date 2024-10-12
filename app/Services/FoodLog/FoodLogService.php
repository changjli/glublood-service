<?php

namespace App\Services\FoodLog;

use App\Models\DailyCalories;
use App\Models\FoodLog;
use Illuminate\Support\Facades\Auth;

class FoodLogService implements FoodLogServiceInterface
{
    public function getByDate(array $query)
    {
        $user = Auth::user();

        $foodLog = FoodLog::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->get();

        return $foodLog;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        FoodLog::create($data);

        $dailyCalories = DailyCalories::where('user_id', $user->id)
            ->where('date', $data['date'])
            ->first();
        $dailyCalories->consumed_calories = $dailyCalories->consumed_calories + $data['calories'];
        return $dailyCalories->save();
    }

    public function update(array $data, $id)
    {
        $foodLog = FoodLog::where('id', $id)->first();

        return $foodLog->update($data);
    }

    public function delete($id)
    {
        $foodLog = FoodLog::where('id', $id)->first();

        return $foodLog->delete();
    }
}
