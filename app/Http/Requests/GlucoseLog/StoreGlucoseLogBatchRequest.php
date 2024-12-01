<?php

namespace App\Http\Requests\GlucoseLog;

use App\Http\Requests\BaseFormRequest;

class StoreGlucoseLogBatchRequest extends BaseFormRequest
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
            'items' => 'required|array',
            'items.*.date' => 'required|date_format:Y-m-d',
            'items.*.glucose_rate' => 'required|numeric',
            'items.*.time' => 'required|string',
            'items.*.time_selection' => 'string',
            'items.*.notes' => 'string|max:300',
            'items.*.type' => 'required:|string|in:manual,auto'
        ];
    }
}
