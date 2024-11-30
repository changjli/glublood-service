<?php

namespace App\Http\Requests\FoodMenu;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetAllFoodMenuRequest extends BaseFormRequest
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
            'keyword' => 'string',
            'limit' => 'numeric',
        ];
    }

    public function validationData()
    {
        // This method ensures query parameters are validated
        return $this->query();
    }
}
