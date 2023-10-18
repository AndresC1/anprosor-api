<?php

namespace App\Http\Requests\Grain;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrainsRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:grains',
            'name' => 'required|string|max:255|unique:grains',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Code is required!',
            'code.string' => 'Code must be a string!',
            'code.max' => 'Code must be less than 255 characters!',
            'code.unique' => 'Code must be unique!',
            'name.required' => 'Name is required!',
            'name.string' => 'Name must be a string!',
            'name.max' => 'Name must be less than 255 characters!',
            'name.unique' => 'Name must be unique!',
        ];
    }
}
