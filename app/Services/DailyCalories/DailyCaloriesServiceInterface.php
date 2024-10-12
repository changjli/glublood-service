<?php

namespace App\Services\DailyCalories;

interface DailyCaloriesServiceInterface
{
    public function getByDate($date);
    public function store(array $data);
    public function updateConsumedCalories($date, $calories);
}
