<?php

namespace App\Http\Resources\GlucoseLog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GlucoseLogDetailResource extends JsonResource
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
            'glucose_rate' => $this->glucose_rate,
            'time_selection' => $this->time_selection,
            'notes' => $this->notes,
            'type' => $this->type,
        ];
    }
}
