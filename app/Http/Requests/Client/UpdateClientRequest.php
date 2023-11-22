<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'string|max:255|unique:clients,name,',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'unique:clients,email,',
            ],
            'phone' => 'nullable|string|max:20',
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
            'name.max' => 'El nombre no debe exceder los :max caracteres',
            'name.unique' => 'El nombre ya está en uso',
            'email.string' => 'El correo electrónico debe ser una cadena de caracteres',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida',
            'email.max' => 'El correo electrónico no debe exceder los :max caracteres',
            'email.unique' => 'El correo electrónico ya está en uso',
            'phone.string' => 'El teléfono debe ser una cadena de caracteres',
            'phone.max' => 'El teléfono no debe exceder los :max caracteres',
        ];
    }
}
