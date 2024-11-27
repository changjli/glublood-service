<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\SaveMenuRequest;
use App\Services\SavedMenu\SavedMenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavedMenuController extends Controller
{
    protected $savedMenuService;

    public function __construct(SavedMenuService $savedMenuService)
    {
        $this->savedMenuService = $savedMenuService;
    }

    public function save(SaveMenuRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->savedMenuService->createOrDeleteSavedMenuService($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success save menu');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
