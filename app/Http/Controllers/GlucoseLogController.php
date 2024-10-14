<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\GlucoseLog\GetGlucoseLogByDateRequest;
use App\Http\Requests\GlucoseLog\StoreGlucoseLogRequest;
use App\Http\Requests\GlucoseLog\UpdateGlucoseLogRequest;
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

            return ResponseTemplate::sendResponseSuccess(message: 'Success get glucose logs by date!', result: $result);
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
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    public function show(GlucoseLog $glucoseLog)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success show glucose log!', result: $glucoseLog);
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
}
