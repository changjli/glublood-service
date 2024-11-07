<?php

namespace App\Http\Resources\ExerciseLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetExerciseLogReportByMonthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'week_range' => $this->week_range,
            'avg_burned_calories' => (float) $this->avg_burned_calories,
            'log_count' => (int) $this->log_count,
        ];
    }
}
