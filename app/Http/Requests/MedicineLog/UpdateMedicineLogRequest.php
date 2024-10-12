<?php

namespace App\Http\Requests\MedicineLog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineLogRequest extends FormRequest
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
            'name' => 'required|string',
            'time' => 'required|date_format:H:i:s',
            'amount' => 'required|numeric',
            'type' => 'required|string',
            'notes' => 'required|string|max:300',
        ];
    }
}
