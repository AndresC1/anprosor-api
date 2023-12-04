<?php

namespace App\Http\Requests\User;

use App\Rules\User\ValidateBothPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->user()->id)
            ],
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
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida',
            'email.unique' => 'El correo electrónico ya está en uso',
            'email.required' => 'El correo electrónico es obligatorio',
        ];
    }
}
