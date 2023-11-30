<?php

namespace App\Http\Requests\Silo;

use App\Rules\Silo\ValidateCurrentCapacityRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiloRequest extends FormRequest
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
            'name' => 'required|string|unique:silos,name',
            'capacity_total' => 'required|numeric|min:0',
            'unit_of_measure' => 'required|string|min:2|max:3|in:ton,kg,qq',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'name is required',
            'name.string' => 'name must be a string',
            'name.unique' => 'name must be unique',
            'capacity_total.required' => 'capacity_total is required',
            'capacity_total.numeric' => 'capacity_total must be a number',
            'capacity_total.min' => 'capacity_total must be at least 0',
            'unit_of_measure.required' => 'unit_of_measure is required',
            'unit_of_measure.string' => 'unit_of_measure must be a string',
            'unit_of_measure.min' => 'unit_of_measure must be at least 2 characters',
            'unit_of_measure.max' => 'unit_of_measure must be at most 3 characters',
            'unit_of_measure.in' => 'unit_of_measure must be one of the following types: ton, kg, qq',
        ];
    }
}
