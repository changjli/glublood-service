<?php

namespace App\Http\Resources\MedicineLog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineLogDetailResource extends JsonResource
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
            'name' => $this->name,
            'amount' => $this->amount,
            'type' => $this->type,
            'notes' => $this->notes,
        ];
    }
}
