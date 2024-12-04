<?php

namespace App\Http\Requests\MedicineLog;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineLogRequest extends FormRequest
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
            'date' => 'required|date',
            'name' => 'required|string',
            'time' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
