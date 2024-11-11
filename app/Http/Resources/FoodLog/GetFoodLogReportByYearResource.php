<?php

namespace App\Http\Resources\FoodLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFoodLogReportByYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'month' => $this->month,
            'avg_calories' => (float) $this->avg_calories,
            'log_count' => (int) $this->log_count,
        ];
    }
}
