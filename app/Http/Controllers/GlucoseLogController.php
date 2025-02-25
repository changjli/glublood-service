<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\GlucoseLog\GetGlucoseLogByDateRequest;
use App\Http\Requests\GlucoseLog\StoreGlucoseLogBatchRequest;
use App\Http\Requests\GlucoseLog\StoreGlucoseLogRequest;
use App\Http\Requests\GlucoseLog\UpdateGlucoseLogRequest;
use App\Http\Requests\LogReport\GetLogReportByDateRequest;
use App\Http\Requests\LogReport\GetLogReportByMonthRequest;
use App\Http\Requests\LogReport\GetLogReportByYearRequest;
use App\Http\Resources\GlucoseLog\GetGlucoseLogReportByDateResource;
use App\Http\Resources\GlucoseLog\GetGlucoseLogReportByMonthResource;
use App\Http\Resources\GlucoseLog\GetGlucoseLogReportByYearResource;
use App\Http\Resources\GlucoseLog\GlucoseLogDetailResource;
use App\Http\Resources\GlucoseLog\GlucoseLogResource;
use App\Models\GlucoseLog;
use App\Services\GlucoseLog\GlucoseLogService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GlucoseLogController extends Controller
{
    protected $glucoseLogService;

    public function __construct(GlucoseLogService $glucoseLogService)
    {
        $this->glucoseLogService = $glucoseLogService;
    }

    public function index(GetGlucoseLogByDateRequest $request)
    {
        try {
            $result = $this->glucoseLogService->getByDate($request->toArray());

            return ResponseTemplate::sendResponseSuccess(message: 'Success get glucose logs by date!', result: new GlucoseLogResource($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function store(StoreGlucoseLogRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->glucoseLogService->store($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Pengisian Glukosa Berhasil');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function show(GlucoseLog $glucoseLog)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success show glucose log!', result:  new GlucoseLogDetailResource($glucoseLog));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function update(UpdateGlucoseLogRequest $request, GlucoseLog $glucoseLog)
    {
        try {
            DB::beginTransaction();

            $this->glucoseLogService->update($request->toArray(), $glucoseLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success update glucose log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function destroy(GlucoseLog $glucoseLog)
    {
        try {
            DB::beginTransaction();

            $this->glucoseLogService->delete($glucoseLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success delete glucose log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getGlucoseLogReportByDate(GetLogReportByDateRequest $request)
    {
        try {
            $result = $this->glucoseLogService->getGlucoseLogReportByDateService($request->start_date, $request->end_date);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by date!', result: GetGlucoseLogReportByDateResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getGlucoseLogReportByMonth(GetLogReportByMonthRequest $request)
    {
        try {
            $result = $this->glucoseLogService->getGlucoseLogReportByMonthService($request->month, $request->year);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by month!', result: GetGlucoseLogReportByMonthResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getGlucoseLogReportByYear(GetLogReportByYearRequest $request)
    {
        try {
            $result = $this->glucoseLogService->getGlucoseLogReportByYearService($request->year);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get report by year!', result: GetGlucoseLogReportByYearResource::collection($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function syncGlucoseLog()
    {
        try {
            $result = $this->glucoseLogService->syncGlucoseLogService();

            return ResponseTemplate::sendResponseSuccess(message: 'Success sync glucose log!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function storeGlucoseLogBatch(StoreGlucoseLogBatchRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->glucoseLogService->storeGlucoseLogBatch($request->toArray()['items']);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Pengisian Glukosa Berhasil');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
