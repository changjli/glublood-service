<?php

namespace App\Http\Resources\MasterFood;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchMasterFoodResource extends JsonResource
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
            'food_name' => $this->food_name,
        ];
    }
}
