<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\FoodMenu\GetAllFoodMenuRequest;
use App\Models\FoodMenu;
use App\Http\Requests\StoreFoodMenuRequest;
use App\Http\Requests\UpdateFoodMenuRequest;
use App\Services\FoodMenu\FoodMenuService;
use Illuminate\Support\Facades\Log;

class FoodMenuController extends Controller
{
    protected $foodMenuService;

    public function __construct(FoodMenuService $foodMenuService)
    {
        $this->foodMenuService = $foodMenuService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetAllFoodMenuRequest $request)
    {
        try {
            $result = $this->foodMenuService->getAllFoodMenuService($request->keyword, $request->limit);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get all food menu!', result: $result);
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
    public function store(StoreFoodMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodMenu $foodMenu)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success get all food menu!', result: $foodMenu);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodMenuRequest $request, FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodMenu $foodMenu)
    {
        //
    }
}
