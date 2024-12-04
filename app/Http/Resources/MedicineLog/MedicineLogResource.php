<?php

namespace App\Http\Resources\MedicineLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MedicineLogResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($medicineLog) {
            return new MedicineLogDetailResource($medicineLog);
        });
    }
}
