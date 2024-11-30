<?php

namespace App\Services\ExerciseLog;

use App\Models\ExerciseLog;
use App\Repositories\ExerciseLogRepository;
use App\Repositories\FoodLogRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExerciseLogService implements ExerciseLogServiceInterface
{
    protected $exerciseLogRepository;

    public function __construct(ExerciseLogRepository $exerciseLogRepository)
    {
        $this->exerciseLogRepository = $exerciseLogRepository;
    }

    public function getByDate($date)
    {
        $user = Auth::user();

        $exerciseLogs = ExerciseLog::where('user_id', $user->id)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get();

        return $exerciseLogs;
    }

    public function store(array $data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;

        return ExerciseLog::create($data);
    }

    public function update(array $data, $id)
    {
        $exerciseLog = ExerciseLog::where('id', $id)->first();

        return $exerciseLog->update($data);
    }

    public function delete($id)
    {
        $exerciseLog = ExerciseLog::where('id', $id)->first();

        return $exerciseLog->delete();
    }

    public function getExerciseLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getExerciseLogReport = $this->exerciseLogRepository->getExerciseLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getExerciseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getExerciseLogReport;
    }

    public function getExerciseLogReportByMonthService(int $month, int $year)
    {
        $user = Auth::user();

        $getExerciseLogReport = $this->exerciseLogRepository->getExerciseLogReportByMonthRepo($user->id, $month, $year);

        if (count($getExerciseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getExerciseLogReport;
    }

    public function getExerciseLogReportByYearService(int $year)
    {
        $user = Auth::user();

        $getExerciseLogReport = $this->exerciseLogRepository->getExerciseLogReportByYearRepo($user->id, $year);

        if (count($getExerciseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getExerciseLogReport;
    }
}
