<?php

namespace App\Http\Resources\GlucoseLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetGlucoseLogReportByDateResource extends JsonResource
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
            'avg_glucose_rate' => (float) $this->avg_glucose_rate,
            'log_count' => (int) $this->log_count,
        ];
    }
}
