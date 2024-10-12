<?php

namespace App\Services\MasterExercise;

use App\Models\MasterExercise;

class MasterExerciseService implements MasterExerciseServiceInterface
{
    public function index($keyword)
    {
        $masterExercises = [];
        if ($keyword) {
            $masterExercises = MasterExercise::where('exercise_name', 'ilike', '%' . $keyword . '%')->get();
        } else {
            $masterExercises = MasterExercise::all();
        }
        return $masterExercises;
    }
}
