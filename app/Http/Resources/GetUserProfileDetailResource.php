<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserProfileDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'weight' => $this->weight,
            'height' => $this->height,
            'age' => $this->age,
            'DOB' => $this->DOB,
            'gender' => $this->gender,
            'is_descendant_diabetes' => $this->is_descendant_diabetes,
            'is_diabetes' => $this->is_diabetes,
            'medical_history' => $this->medical_history,
            'diabetes_type' => $this->diabetes_type,
        ];
    }
}
