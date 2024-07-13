<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age' => 'required|integer',
            'DOB' => 'required|date',
            'gender' => 'required|string|max:10',
            'is_descendant_diabetes' => 'required|boolean',
            'is_diabetes' => 'required|boolean',
            'medical_history' => 'required|string|max:500',
            'diabetes_type' => 'required|integer',
        ];
    }
}
