<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\LogReport\GetAllLogReportByDateRequest;
use App\Http\Resources\LogReport\GetAllLogReportByDateResource;
use App\Http\Resources\LogReport\GetExerciseLogReportByDateResource;
use App\Http\Resources\LogReport\GetFoodLogReportByDateResource;
use App\Http\Resources\LogReport\GetGlucoseLogReportByDateResource;
use App\Http\Resources\LogReport\GetMedicineLogReportByDateResource;
use App\Services\LogReport\LogReportService;
use Illuminate\Http\Request;

class LogReportController extends Controller
{
    protected $logReportService;

    public function __construct(LogReportService $logReportService)
    {
        $this->logReportService = $logReportService;
    }

    public function getAllLogReportByDate(GetAllLogReportByDateRequest $request)
    {
        try {
            $data = [];
            if ($request->food_log) {
                $result = $this->logReportService->getFoodLogReportByDateService($request->start_date, $request->end_date);
                $data['food_log'] = new GetFoodLogReportByDateResource($result);
            }
            if ($request->exercise_log) {
                $result = $this->logReportService->getExerciseLogReportByDateService($request->start_date, $request->end_date);
                $data['exercise_log'] = new GetExerciseLogReportByDateResource($result);
            }
            if ($request->glucose_log) {
                $result = $this->logReportService->getGlucoseLogReportByDateService($request->start_date, $request->end_date);
                $data['glucose_log'] = new GetGlucoseLogReportByDateResource($result);
            }
            if ($request->medicine_log) {
                $result = $this->logReportService->getMedicineLogReportByDateService($request->start_date, $request->end_date);
                $data['medicine_log'] = new GetMedicineLogReportByDateResource($result);
            }

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by date!', result: $data);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getAllLogReportByDateV2(GetAllLogReportByDateRequest $request)
    {
        try {
            $result = $this->logReportService->getAllLogReportByDateService(
                $request->start_date,
                $request->end_date,
                $request->food_log,
                $request->exercise_log,
                $request->glucose_log,
                $request->medicine_log
            );

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by date!', result: GetAllLogReportByDateResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
