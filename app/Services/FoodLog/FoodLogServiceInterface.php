<?php

namespace App\Services\FoodLog;

interface FoodLogServiceInterface
{
    public function getByDate(array $query);
    public function store(array $data, $foodImage);
    public function update(array $data, $id, $foodImage);
    public function delete(array $data);
}
