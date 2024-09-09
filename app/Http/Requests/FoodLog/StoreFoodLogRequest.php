<?php

namespace App\Http\Requests\FoodLog;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreFoodLogRequest extends BaseFormRequest
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
            'time' => 'required|date_format:H:i',
            'type' => 'required',
            'food_name' => 'required',
            'calories' => 'required',
            'protein' => 'required',
            'carbohydrate' => 'required',
            'fat' => 'required',
            'serving' => 'required',
        ];
    }
}
