<?php

namespace App\Http\Resources\LogReport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetExerciseLogReportByDateResource extends ResourceCollection
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
                        'avg_burned_calories' => round($item->avg_burned_calories, 2),
                    ];
                })->values(),
            ];
        })->values()->toArray();
    }
}
