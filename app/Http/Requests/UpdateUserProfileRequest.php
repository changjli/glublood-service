<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateUserProfileRequest extends BaseFormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age' => 'required|integer',
            'DOB' => 'required|date',
            'gender' => 'required|string|max:255',
            'is_descendant_diabetes' => 'required|boolean',
            'is_diabetes' => 'required|boolean',
            'medical_history' => 'required|string|max:500',
            'diabetes_type' => 'integer',
            'image' => 'string',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     *
     * @throws \JsonException
     */
    protected function prepareForValidation(): void
    {
        Log::info($this);
        $this->merge(json_decode($this->payload, true));
    }
}
