<?php

namespace App\Http\Requests\Grain;

use App\Models\Grains;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGrainsRequest extends FormRequest
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
        $granID = Grains::find(request()->route('grain'))->id;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('grains', 'name')->whereNot('id', $granID)
            ]
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
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'name.unique' => 'El nombre ya está en uso',
        ];
    }
}
