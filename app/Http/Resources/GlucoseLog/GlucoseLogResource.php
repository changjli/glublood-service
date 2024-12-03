<?php

namespace App\Http\Resources\GlucoseLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GlucoseLogResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($glucoseLog) {
            return new GlucoseLogDetailResource($glucoseLog);
        });
    }
}
