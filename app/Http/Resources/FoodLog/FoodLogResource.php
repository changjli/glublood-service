<?php

namespace App\Http\Resources\FoodLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodLogResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($foodLog) {
            return new FoodLogDetailResource($foodLog);
        });
    }
}
