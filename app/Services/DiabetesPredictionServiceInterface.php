<?php

namespace App\Services;

interface DiabetesPredictionServiceInterface
{
    public function getByUserId($user_id);
    public function getById($id);
    public function create(array $data);
    public function predict(array $data);
}
