<?php

namespace App\Http\Requests\Paginate;

use Illuminate\Foundation\Http\FormRequest;

class IndexPaginateRequest extends FormRequest
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
            'paginate' => 'in:true,false|nullable',
            'per_page' => 'integer|min:1|nullable',
            'OrderBy' => 'string|nullable|in:asc,desc',
            'type' => 'string|nullable|in:completado,en_curso',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'paginate.in' => 'paginate must be true or false',
            'per_page.integer' => 'page must be integer',
            'per_page.min' => 'page must be greater than 0',
            'OrderBy.string' => 'OrderBy must be string',
            'OrderBy.in' => 'OrderBy must be asc or desc',
            'type.string' => 'type must be string',
            'type.in' => 'type must be completado or en_curso',
        ];
    }
}
