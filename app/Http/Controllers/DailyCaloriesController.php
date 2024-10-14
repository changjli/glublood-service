<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\DailyCalories\GetDailyCaloriesByDateRequest;
use App\Http\Requests\DailyCalories\StoreDailyCaloriesRequest;
use App\Services\DailyCalories\DailyCaloriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyCaloriesController extends Controller
{
    protected $dailyCaloriesService;

    public function __construct(DailyCaloriesService $dailyCaloriesService)
    {
        $this->dailyCaloriesService = $dailyCaloriesService;
    }

    public function index(GetDailyCaloriesByDateRequest $request)
    {
        try {
            $result = $this->dailyCaloriesService->getByDate($request['date']);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get daily calories by date!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function store(StoreDailyCaloriesRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->dailyCaloriesService->store($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success store daily calories log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
