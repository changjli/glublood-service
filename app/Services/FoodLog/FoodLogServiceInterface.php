<?php

namespace App\Services\FoodLog;

interface FoodLogServiceInterface
{
    public function getByDate(array $query);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete(array $data);
}
