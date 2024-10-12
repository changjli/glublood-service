<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\MasterExercise\SearchMasterExerciseRequest;
use App\Http\Requests\MasterExercises\GetAllRequest;
use App\Models\MasterExercise;
use App\Http\Requests\StoreMasterExerciseRequest;
use App\Http\Requests\UpdateMasterExerciseRequest;
use App\Http\Resources\MasterExercise\MasterExerciseCollectionResource;
use App\Services\MasterExercise\MasterExerciseService;

class MasterExerciseController extends Controller
{
    protected $masterExerciseService;

    public function __construct(MasterExerciseService $masterExerciseService)
    {
        $this->masterExerciseService = $masterExerciseService;
    }

    public function index(GetAllRequest $request)
    {
        try {
            $data = $this->masterExerciseService->index($request['query']);

            return ResponseTemplate::sendResponseSuccess(message: 'Success get all master exercises!', result: new MasterExerciseCollectionResource($data));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
