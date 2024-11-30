<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\ExerciseLog\GetByDateRequest;
use App\Http\Requests\ExerciseLog\StoreExerciseLogRequest;
use App\Http\Requests\ExerciseLog\UpdateExerciseLogRequest;
use App\Http\Requests\LogReport\GetLogReportByDateRequest;
use App\Http\Requests\LogReport\GetLogReportByMonthRequest;
use App\Http\Requests\LogReport\GetLogReportByYearRequest;
use App\Http\Resources\ExerciseLog\ExerciseLogResource;
use App\Http\Resources\ExerciseLog\GetExerciseLogReportByDateResource;
use App\Http\Resources\ExerciseLog\GetExerciseLogReportByMonthResource;
use App\Http\Resources\ExerciseLog\GetExerciseLogReportByYearResource;
use App\Models\ExerciseLog;
use App\Services\ExerciseLog\ExerciseLogService;
use Illuminate\Support\Facades\DB;

class ExerciseLogController extends Controller
{
    protected $exerciseLogService;

    public function __construct(ExerciseLogService $exerciseLogService)
    {
        $this->exerciseLogService = $exerciseLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetByDateRequest $request)
    {
        try {
            $result = $this->exerciseLogService->getByDate($request['date']);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get exercise logs by date!', result: ExerciseLogResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseLogRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->exerciseLogService->store($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success store exercise log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExerciseLog $exerciseLog)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success show exercise log!', result: new ExerciseLogResource($exerciseLog));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseLogRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $this->exerciseLogService->update($request->toArray(), $id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success update exercise log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExerciseLog $exerciseLog)
    {
        try {
            DB::beginTransaction();

            $this->exerciseLogService->delete($exerciseLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success delete exercise log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getExerciseLogReportByDate(GetLogReportByDateRequest $request)
    {
        try {
            $result = $this->exerciseLogService->getExerciseLogReportByDateService($request->start_date, $request->end_date);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by date!', result: GetExerciseLogReportByDateResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getExerciseLogReportByMonth(GetLogReportByMonthRequest $request)
    {
        try {
            $result = $this->exerciseLogService->getExerciseLogReportByMonthService($request->month, $request->year);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by month!', result: GetExerciseLogReportByMonthResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getExerciseLogReportByYear(GetLogReportByYearRequest $request)
    {
        try {
            $result = $this->exerciseLogService->getExerciseLogReportByYearService($request->year);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by year!', result: GetExerciseLogReportByYearResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
