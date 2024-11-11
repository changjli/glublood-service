<?php

namespace App\Http\Resources\LogReport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetGlucoseLogReportByDateResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->groupBy('date')->map(function ($items, $date) {
            return [
                'date' => $date,
                'data' => $items->map(function ($item) {
                    return [
                        'description' => $item->description,
                        'avg_glucose_rate' => round($item->avg_glucose_rate, 2),
                    ];
                })->values(),
            ];
        })->values()->toArray();
    }
}
