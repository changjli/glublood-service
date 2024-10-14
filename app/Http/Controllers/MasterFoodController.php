<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\MasterFood\SearchRequest;
use App\Http\Resources\MasterFood\SearchMasterFoodResource;
use App\Models\MasterFood;
use App\Services\MasterFood\MasterFoodService;
use Illuminate\Support\Facades\Log;

class MasterFoodController extends Controller
{
    protected $masterFoodService;

    public function __construct(MasterFoodService $masterFoodService)
    {
        $this->masterFoodService = $masterFoodService;
    }

    public function search(SearchRequest $request)
    {
        try {
            $result = $this->masterFoodService->search($request['query']);

            return ResponseTemplate::sendResponseSuccess(message: 'Success search master food!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function show($id)
    {
        try {
            $result = $this->masterFoodService->show($id);

            return ResponseTemplate::sendResponseSuccess(message: 'Success show master food!', result: $result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
