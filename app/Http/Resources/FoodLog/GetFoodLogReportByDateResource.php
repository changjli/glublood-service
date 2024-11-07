<?php

namespace App\Http\Resources\FoodLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFoodLogReportByDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->date,
            'avg_calories' => (float) $this->avg_calories,
        ];
    }
}
