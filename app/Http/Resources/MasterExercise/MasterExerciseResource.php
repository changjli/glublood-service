<?php

namespace App\Http\Resources\MasterExercise;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MasterExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'exercise_name' => $this->exercise_name,
            'calories_per_kg' => $this->calories_per_kg,
        ];
    }
}
