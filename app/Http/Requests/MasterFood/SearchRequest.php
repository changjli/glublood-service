<?php

namespace App\Http\Requests\MasterFood;

use App\Http\Requests\BaseFormRequest;

class SearchRequest extends BaseFormRequest
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
            'query' => 'required'
        ];
    }

    public function validationData()
    {
        // This method ensures query parameters are validated
        return $this->query();
    }
}
