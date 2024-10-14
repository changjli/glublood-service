<?php

namespace App\Services\ExerciseLog;

interface ExerciseLogServiceInterface
{
    public function getByDate($date);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
