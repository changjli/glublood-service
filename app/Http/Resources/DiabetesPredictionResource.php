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
            'high_bp' => $this->high_bp,
            'high_chol' => $this->high_chol,
            'chol_check' => $this->chol_check,
            'bmi' => (float) $this->bmi,
            'smoker' => $this->smoker,
            'stroke' => $this->stroke,
            'heart_disease' => $this->heart_disease,
            'phys_activity' => $this->phys_activity,
            'fruits' => $this->fruits,
            'veggies' => $this->veggies,
            'hvy_alcohol' => $this->hvy_alcohol,
            'any_healthcare' => $this->any_healthcare,
            'no_doc' => $this->no_doc,
            'gen_health' => $this->gen_health,
            'mental_health' => $this->mental_health,
            'phys_health' => $this->phys_health,
            'diff_walk' => $this->diff_walk,
            'sex' => $this->sex,
            'age' => $this->age,
            'created_at' => $this->created_at,
            'result' => (int) $this->result,
        ];
    }
}
