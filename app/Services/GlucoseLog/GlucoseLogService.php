<?php

namespace App\Services\GlucoseLog;

use App\Models\GlucoseLog;
use App\Repositories\GlucoseLogRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GlucoseLogService implements GlucoseLogServiceInterface
{

    protected $glucoseLogRepository;

    public function __construct(GlucoseLogRepository $glucoseLogRepository)
    {
        $this->glucoseLogRepository = $glucoseLogRepository;
    }

    public function getByDate(array $query)
    {
        $user = auth()->user();

        $glucoseLog = GlucoseLog::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->get();

        return $glucoseLog;
    }

    public function store(array $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;

        GlucoseLog::create(attributes: $data);
    }

    public function update(array $data, $id)
    {
        $glucoseLog = GlucoseLog::where('id', $id)->first();

        return $glucoseLog->update($data);
    }

    public function delete($id)
    {
        $glucoseLog = GlucoseLog::where('id', operator: $id)->first();

        return $glucoseLog->delete();
    }

    public function getGlucoseLogReportByDateService(string $startDate, string $endDate)
    {
        $user = Auth::user();

        $getGlucoseLogReport = $this->glucoseLogRepository->getGlucoseLogReportByDateRepo($user->id, $startDate, $endDate);

        if (count($getGlucoseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getGlucoseLogReport;
    }

    public function getGlucoseLogReportByMonthService(int $month, int $year)
    {
        $user = Auth::user();

        $getGlucoseLogReport = $this->glucoseLogRepository->getGlucoseLogReportByMonthRepo($user->id, $month, $year);

        if (count($getGlucoseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getGlucoseLogReport;
    }

    public function getGlucoseLogReportByYearService(int $year)
    {
        $user = Auth::user();

        $getGlucoseLogReport = $this->glucoseLogRepository->getGlucoseLogReportByYearRepo($user->id, $year);

        if (count($getGlucoseLogReport) < 1) {
            throw new NotFoundHttpException();
        }

        return $getGlucoseLogReport;
    }
}
