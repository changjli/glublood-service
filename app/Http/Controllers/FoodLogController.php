<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\FoodLog\GetByBarcodeRequest;
use App\Http\Requests\FoodLog\GetByDateRequest;
use App\Http\Requests\FoodLog\SearchFoodRequest;
use App\Http\Requests\FoodLog\StoreFoodLogRequest;
use App\Http\Requests\FoodLog\UpdateFoodLogRequest;
use App\Http\Resources\FoodLog\FoodLogDetailResource;
use App\Http\Resources\FoodLog\FoodLogResource;
use App\Models\FoodLog;
use App\Services\DailyCalories\DailyCaloriesService;
use App\Services\FoodLog\FoodLogService;
use App\Services\OpenFoodFacts\OpenFoodFactsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FoodLogController extends Controller
{
    protected $openFoodFactsService;
    protected $foodLogService;
    protected $dailyCaloriesService;

    public function __construct(OpenFoodFactsService $openFoodFactsService, FoodLogService $foodLogService, DailyCaloriesService $dailyCaloriesService)
    {
        $this->openFoodFactsService = $openFoodFactsService;
        $this->foodLogService = $foodLogService;
        $this->dailyCaloriesService = $dailyCaloriesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetByDateRequest $request)
    {
        try {
            $result = $this->foodLogService->getByDate($request->toArray());

            return ResponseTemplate::sendResponseSuccess(message: 'Success get food logs by date!', result: new FoodLogResource($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodLogRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->foodLogService->store($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success store food log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodLog $foodLog)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success show food log!', result: new FoodLogDetailResource($foodLog));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodLog $foodLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodLogRequest $request, FoodLog $foodLog)
    {
        try {
            DB::beginTransaction();

            $this->foodLogService->update($request->toArray(), $foodLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success update food log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodLog $foodLog)
    {
        try {
            DB::beginTransaction();

            $this->foodLogService->delete($foodLog);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success delete food log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getByBarcode(GetByBarcodeRequest $request)
    {
        try {
            $result = $this->openFoodFactsService->getByBarcode($request->barcode);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get by barcode!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function search(SearchFoodRequest $request)
    {
        try {
            $result = $this->openFoodFactsService->search($request['keyword']);

            return ResponseTemplate::sendResponseSuccess(message: 'Success search!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
