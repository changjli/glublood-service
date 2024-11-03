<?php

namespace App\Services\FoodLog;

use App\Models\DailyCalories;
use App\Models\FoodLog;
use App\Repositories\FoodLogRepository;
use App\Services\DailyCalories\DailyCaloriesService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FoodLogService implements FoodLogServiceInterface
{
    protected $dailyCaloriesService;
    protected $foodLogRepository;

    public function __construct(DailyCaloriesService $dailyCaloriesService, FoodLogRepository $foodLogRepository)
    {
        $this->dailyCaloriesService = $dailyCaloriesService;
        $this->foodLogRepository = $foodLogRepository;
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

    public function store(array $data, $foodImage)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        if ($foodImage) {
            // Store food image
            $data['image'] = Storage::url(Storage::disk('local')->put('public', $foodImage));
        }

        // Create food log
        FoodLog::create($data);

        // Add consumed calories
        $this->dailyCaloriesService->updateConsumedCalories($data['date'], $data['calories']);

        return;
    }

    public function update(array $data, $id, $foodImage)
    {
        $foodLog = FoodLog::where('id', $id)->firstOrFail();

        $oldCalories = $foodLog->calories;

        if ($foodImage) {
            // Store food image
            $data['image'] = Storage::url(Storage::disk('local')->put('public', $foodImage));

            // Delete old image
            Storage::disk('local')->delete(str_replace('/storage', 'public', $foodLog->image));
        }

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

        if ($foodLog->image) {
            // Delete old image
            Storage::disk('local')->delete(str_replace('/storage', 'public', $foodLog->image));
        }

        $this->dailyCaloriesService->updateConsumedCalories($data['date'], -$data['calories']);

        $foodLog->delete();

        return;
    }

    public function getFoodLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getFoodLogReport = $this->foodLogRepository->getFoodLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getFoodLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getFoodLogReport;
    }

    public function getFoodLogReportByMonthService(int $month, int $year)
    {
        $user = Auth::user();

        $getFoodLogReport = $this->foodLogRepository->getFoodLogReportByMonthRepo($user->id, $month, $year);

        if (count($getFoodLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getFoodLogReport;
    }

    public function getFoodLogReportByYearService(int $year)
    {
        $user = Auth::user();

        $getFoodLogReport = $this->foodLogRepository->getFoodLogReportByYearRepo($user->id, $year);

        if (count($getFoodLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getFoodLogReport;
    }
}
