<?php

namespace App\Http\Resources\GlucoseLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetGlucoseLogReportByYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'month' => $this->month,
            'avg_glucose_rate' => (float) $this->avg_glucose_rate,
            'log_count' => (int) $this->log_count,
        ];
    }
}
