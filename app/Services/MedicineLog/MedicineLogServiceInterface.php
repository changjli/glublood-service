<?php

namespace App\Services\MedicineLog;

interface MedicineLogServiceInterface
{
    public function getByDate(array $query);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
