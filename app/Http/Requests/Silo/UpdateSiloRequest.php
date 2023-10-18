<?php

namespace App\Http\Requests\Silo;

use App\Models\Silo;
use App\Rules\Silo\ValidateCapacityTotalRule;
use App\Rules\Silo\ValidateCapacityUsedRule;
use App\Rules\Silo\ValidateCurrentCapacityRule;
use App\Rules\Silo\ValidateUsedCapacityRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiloRequest extends FormRequest
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
            'code' => 'string|unique:silos,code',
            'name' => 'string|unique:silos,name',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.string' => 'code must be a string',
            'code.unique' => 'code must be unique',
            'name.string' => 'name must be a string',
            'name.unique' => 'name must be unique',
        ];
    }
}