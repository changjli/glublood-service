<?php

namespace App\Http\Resources\FoodLog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodLogDetailResource extends JsonResource
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
            'date' => $this->date,
            'time' => Carbon::parse($this->time)->format('H:i'),
            'food_name' => $this->food_name,
            'calories' => $this->calories,
            'protein' => $this->protein,
            'carbohydrate' => $this->carbohydrate,
            'fat' => $this->fat,
            'serving_qty' => $this->serving_qty,
            'serving_size' => $this->serving_size,
            'note' => $this->note,
            'type' => $this->type,
        ];
    }
}
