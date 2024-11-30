<?php

namespace App\Http\Resources\ExerciseLog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseLogResource extends JsonResource
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
            'date' => $this->date,
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'burned_calories' => round($this->burned_calories, 2),
            'calories_per_kg' => round($this->calories_per_kg, 2),
        ];
    }
}
