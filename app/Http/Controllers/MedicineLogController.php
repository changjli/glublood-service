<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineLog\GetMedicineByDateRequest;
use App\Http\Requests\MedicineLog\StoreMedicineLogRequest;
use App\Http\Requests\MedicineLog\UpdateMedicineLogRequest;
use App\Http\Resources\MedicineLog\MedicineLogDetailResource;
use App\Http\Resources\MedicineLog\MedicineLogResource;
use App\Models\Medicine;
use App\Services\MedicineLog\MedicineLogService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MedicineLogController extends Controller
{
    protected $medicineLogService;

    public function __construct(MedicineLogService $medicineLogService)
    {
        $this->medicineLogService = $medicineLogService;
    }

    public function index(GetMedicineByDateRequest $request)
    {
        try {
            $result = $this->medicineLogService->getByDate($request->toArray());

            return ResponseTemplate::sendResponseSuccess(message: 'Success get medicine logs by date!', result: new MedicineLogResource($result));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function store(StoreMedicineLogRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->medicineLogService->store($request->toArray());

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Pengisian Obat Berhasil');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function show(Medicine $medicineLog)
    {
        try {
            return ResponseTemplate::sendResponseSuccess(message: 'Success show medicine log!', result: new MedicineLogDetailResource($medicineLog));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function update(UpdateMedicineLogRequest $request, Medicine $medicineLog)
    {
        try {
            DB::beginTransaction();

            $this->medicineLogService->update($request->toArray(), $medicineLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success update medicine log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function destroy(Medicine $medicineLog)
    {
        try {
            DB::beginTransaction();

            $this->medicineLogService->delete($medicineLog->id);

            DB::commit();
            return ResponseTemplate::sendResponseSuccess(message: 'Success delete medicine log!');
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
