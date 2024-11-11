<?php

namespace App\Http\Resources\FoodLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFoodLogReportByMonthResource extends JsonResource
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
            'avg_calories' => (float) $this->avg_calories,
            'log_count' => (int) $this->log_count,
        ];
    }
}
