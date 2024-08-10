<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiabetesPredictionRequest extends BaseFormRequest
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
            'pregnancies' => 'required',
            'glucose' => 'required',
            'blood_pressure' => 'required',
            'skin_thickness' => 'required',
            'insulin' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'is_father' => 'required',
            'is_mother' => 'required',
            'is_sister' => 'required',
            'is_brother' => 'required',
            'age' => 'required',
        ];
    }
}
