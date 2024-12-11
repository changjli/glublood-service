<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\PredictDiabetesPredictionRequest;
use App\Http\Requests\PredictDiabetesRequest;
use App\Models\DiabetesPrediction;
use App\Http\Requests\StoreDiabetesPredictionRequest;
use App\Http\Requests\UpdateDiabetesPredictionRequest;
use App\Http\Resources\DiabetesPredictionCollection;
use App\Http\Resources\DiabetesPredictionResource;
use App\Services\DiabetesPredictionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiabetesPredictionController extends Controller
{
    protected $diabetesPredictionService;

    public function __construct(DiabetesPredictionService $diabetesPredictionService)
    {
        $this->diabetesPredictionService = $diabetesPredictionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();

            $data = $this->diabetesPredictionService->getByUserId($user->id);

            if (!$data) {
                return ResponseTemplate::sendResponseError(message: 'No data found!');
            }

            return ResponseTemplate::sendResponseSuccess(message: 'Success get all diabetes prediction!', result: new DiabetesPredictionCollection($data), code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
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
    public function store(StoreDiabetesPredictionRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $request['user_id'] = $user->id;

            $result = $this->diabetesPredictionService->create($request->toArray());

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Success save diabetes prediction!', result: ['result' => $result], code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DiabetesPrediction $diabetesPrediction)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success get diabetes prediction!', result: $diabetesPrediction, code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiabetesPrediction $diabetesPrediction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiabetesPredictionRequest $request, DiabetesPrediction $diabetesPrediction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiabetesPrediction $diabetesPrediction)
    {
        //
    }

    public function predict(PredictDiabetesPredictionRequest $request)
    {
        try {
            $result = $this->diabetesPredictionService->predict($request->toArray());

            return ResponseTemplate::sendResponseSuccess(message: 'Success predict diabetes!', result: ['result' => $result], code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }

    public function predictV2(PredictDiabetesRequest $request)
    {
        try {
            $result = $this->diabetesPredictionService->predictV2($request->toArray());

            return ResponseTemplate::sendResponseSuccess(message: 'Success predict diabetes!', result: ['result' => $result], code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }
}
