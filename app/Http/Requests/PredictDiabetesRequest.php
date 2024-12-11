<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PredictDiabetesRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'high_bp' => 'required',
            'high_chol' => 'required',
            'chol_check' => 'required',
            'bmi' => 'required',
            'smoker' => 'required',
            'stroke' => 'required',
            'heart_disease' => 'required',
            'phys_activity' => 'required',
            'fruits' => 'required',
            'veggies' => 'required',
            'hvy_alcohol' => 'required',
            'any_healthcare' => 'required',
            'no_doc' => 'required',
            'gen_health' => 'required',
            'mental_health' => 'required',
            'phys_health' => 'required',
            'diff_walk' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ];
    }
}
