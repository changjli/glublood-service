<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\ExerciseLog\GetByDateRequest;
use App\Http\Requests\ExerciseLog\StoreExerciseLogRequest;
use App\Http\Requests\ExerciseLog\UpdateExerciseLogRequest;
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

            return ResponseTemplate::sendResponseSuccess(message: 'Success get exercise logs by date!', result: $result);
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
            return ResponseTemplate::sendResponseSuccess(message: 'Success show exercise log!', result: $exerciseLog);
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
        //
    }
}
