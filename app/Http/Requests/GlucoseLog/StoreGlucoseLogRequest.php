<?php

namespace App\Http\Requests\GlucoseLog;

use App\Http\Requests\BaseFormRequest;

class StoreGlucoseLogRequest extends BaseFormRequest
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
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|string',
            'time_selection' => 'required|string',
            'type' => 'required:|string|in:manual,auto'
        ];
    }
}
