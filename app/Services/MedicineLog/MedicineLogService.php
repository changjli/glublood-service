<?php

namespace App\Services\MedicineLog;

use App\Models\Medicine;
use App\Services\MedicineLog\MedicineLogServiceInterface;

class MedicineLogService implements MedicineLogServiceInterface
{
    public function getByDate(array $query)
    {
        $user = auth()->user();

        $medicineLog = Medicine::where('user_id', $user->id)
            ->where('date', $query['date'])
            ->orderBy('time')
            ->get();

        return $medicineLog;
    }

    public function store(array $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;

        Medicine::create($data);
    }

    public function update(array $data, $id)
    {
        $medicineLog = Medicine::where('id', $id)->first();

        return $medicineLog->update($data);
    }

    public function delete($id)
    {
        $medicineLog = Medicine::where('id', $id)->first();

        return $medicineLog->delete();
    }
}
