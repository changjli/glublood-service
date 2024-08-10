<?php

namespace App\Repositories;

interface DiabetesPredictionRepositoryInterface
{
    public function getByUserId($user_id);
    public function getById($id);
    public function create(array $data);
}
