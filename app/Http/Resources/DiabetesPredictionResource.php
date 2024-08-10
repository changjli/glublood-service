<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiabetesPredictionResource extends JsonResource
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
            'user_id' => $this->user_id,
            'pregnancies' => $this->pregnancies,
            'glucose' => $this->glucose,
            'blood_pressure' => $this->blood_pressure,
            'skin_thickness' => $this->skin_thickness,
            'insulin' => $this->insulin,
            'bmi' => $this->bmi,
            'diabetes_pedigree' => $this->diabetes_pedigree,
            'result' => $this->result,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
