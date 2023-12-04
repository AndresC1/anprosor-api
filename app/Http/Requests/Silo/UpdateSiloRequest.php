<?php

namespace App\Http\Requests\Silo;

use App\Models\Silo;
use App\Rules\Silo\ValidateCapacityTotalRule;
use App\Rules\Silo\ValidateCapacityUsedRule;
use App\Rules\Silo\ValidateCurrentCapacityRule;
use App\Rules\Silo\ValidateUsedCapacityRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $siloID = Silo::find(request()->route('silos'))->id;
        return [
            'name' => [
                'string',
                'max:255',
                Rule::unique(Silo::class, 'name')->whereNot('id', $siloID),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.unique' => 'El nombre ya está en uso',
        ];
    }
}
