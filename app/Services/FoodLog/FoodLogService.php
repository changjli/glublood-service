<?php

namespace App\Services\FoodLog;

use App\Models\DailyCalories;
use App\Models\FoodLog;
use App\Services\DailyCalories\DailyCaloriesService;
use Illuminate\Support\Facades\Auth;

class FoodLogService implements FoodLogServiceInterface
{
    protected $dailyCaloriesService;

    public function __construct(DailyCaloriesService $dailyCaloriesService)
    {
        $this->dailyCaloriesService = $dailyCaloriesService;
    }

    public function getByDate(array $query)
    {
        $user = Auth::user();

        $foodLog = FoodLog::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->orderBy('time')
            ->get();

        return $foodLog;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        // Create food log
        FoodLog::create($data);

        // Add consumed calories
        $this->dailyCaloriesService->updateConsumedCalories($data['date'], $data['calories']);

        return;
    }

    public function update(array $data, $id)
    {
        $foodLog = FoodLog::where('id', $id)->firstOrFail();

        $oldCalories = $foodLog->calories;

        // Update food log
        $foodLog->update($data);

        // Substract consumed calories
        $this->dailyCaloriesService->updateConsumedCalories($data['date'], -$oldCalories);

        // Add consumed calories
        $this->dailyCaloriesService->updateConsumedCalories($data['date'], $data['calories']);

        return;
    }

    public function delete($data)
    {
        $foodLog = FoodLog::where('id', $data['id'])->firstOrFail();

        $this->dailyCaloriesService->updateConsumedCalories($data['date'], -$data['calories']);

        $foodLog->delete();

        return;
    }
}
