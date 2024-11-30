<?php

namespace App\Services\LogReport;

use App\Repositories\LogReportRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LogReportService
{
    protected $logReportRepository;

    public function __construct(LogReportRepository $logReportRepository)
    {
        $this->logReportRepository = $logReportRepository;
    }

    public function getFoodLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getFoodLogReport = $this->logReportRepository->getFoodLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getFoodLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getFoodLogReport;
    }

    public function getExerciseLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getExerciseLogReport = $this->logReportRepository->getExerciseLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getExerciseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getExerciseLogReport;
    }

    public function getGlucoseLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getGlucoseLogReport = $this->logReportRepository->getGlucoseLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getGlucoseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getGlucoseLogReport;
    }

    public function getMedicineLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getMedicineLogReport = $this->logReportRepository->getMedicineLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getMedicineLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getMedicineLogReport;
    }

    public function getAllLogReportByDateService(
        string $startDate,
        string $endDate,
        $includeFoodLog,
        $includeExerciseLog,
        $includeGlucoseLog,
        $includeMedicineLog
    ) {
        $user = Auth::user();

        $getAllReport = $this->logReportRepository->getAllLogReportByDateRepo($user->id, $startDate, $endDate, $includeFoodLog, $includeExerciseLog, $includeGlucoseLog, $includeMedicineLog);

        if (count($getAllReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getAllReport;
    }
}
