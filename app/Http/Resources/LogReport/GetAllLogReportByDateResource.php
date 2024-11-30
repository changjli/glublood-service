<?php

namespace App\Http\Resources\LogReport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllLogReportByDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = [
            'date' => $this->date,
            'description' => $this->description,
        ];

        if (isset($this->avg_calories)) {
            $array['avg_calories'] = round($this->avg_calories, 2);
        }
        if (isset($this->avg_burned_calories)) {
            $array['avg_burned_calories'] = round($this->avg_burned_calories, 2);
        }
        if (isset($this->avg_glucose_rate)) {
            $array['avg_glucose_rate'] = round($this->avg_glucose_rate, 2);
        }
        if (isset($this->medicine_details)) {
            $array['medicine_details'] = $this->medicine_details;
        }

        return $array;
    }
}
