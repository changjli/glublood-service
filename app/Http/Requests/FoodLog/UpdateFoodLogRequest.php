<?php

namespace App\Http\Requests\FoodLog;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodLogRequest extends BaseFormRequest
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
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'type' => 'required',
            'food_name' => 'required',
            'calories' => 'required',
            'protein' => 'required',
            'carbohydrate' => 'required',
            'fat' => 'required',
            'serving_size' => 'required',
            'serving_qty' => 'required',
            'food_image' => 'file'
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
        $this->merge(json_decode($this->payload, true));
    }
}
