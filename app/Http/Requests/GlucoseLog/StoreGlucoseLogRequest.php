<?php

namespace App\Http\Requests\GlucoseLog;

use Illuminate\Foundation\Http\FormRequest;

class StoreGlucoseLogRequest extends FormRequest
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
            'glucose_rate' => 'required|numeric',
            'time' => 'required|string',
            'time_selection' => 'required|string',
            'notes' => 'required|string|max:300',
        ];
    }
}