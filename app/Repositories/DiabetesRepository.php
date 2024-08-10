<?php

namespace App\Repositories;

use App\Models\DiabetesPrediction;

class DiabetesPredictionRepository implements DiabetesPredictionRepositoryInterface
{
    public function getByUserId($user_id)
    {
        return DiabetesPrediction::where('user_id', $user_id)->get();
    }

    public function getById($id)
    {
        return DiabetesPrediction::where('id', $id)->get();
    }

    public function create(array $data)
    {
        return DiabetesPrediction::create($data);
    }
}
