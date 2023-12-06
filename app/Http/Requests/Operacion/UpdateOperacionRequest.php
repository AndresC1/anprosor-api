<?php

namespace App\Http\Requests\Operacion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperacionRequest extends FormRequest
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
            'movimiento' => 'required|string|in:remision,ingreso',
            'estado' => 'required|string|in:en_proceso,finalizado,cancelada',
            'numero_documento' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i:s',
            'hora_salida' => 'date_format:H:i:s|nullable',
            'nombre_conductor' => 'string|max:255|nullable',
            'cedula_conductor' => 'string|max:255|nullable',
            'placa_vehiculo' => 'string|max:255|nullable',
            'observaciones' => 'string|max:255|nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'numero_documento.required' => 'El numero de documento es requerido',
            'numero_documento.string' => 'El numero de documento debe ser un texto',
            'numero_documento.max' => 'El numero de documento debe tener maximo 255 caracteres',
            'fecha_registro.date' => 'La fecha de registro debe ser una fecha',
            'hora_entrada.required' => 'La hora de entrada es requerida',
            'hora_entrada.date_format' => 'La hora de entrada debe ser una hora',
            'hora_salida.required' => 'La hora de salida es requerida',
            'hora_salida.date_format' => 'La hora de salida debe ser una hora',
            'nombre_conductor.string' => 'El nombre del conductor debe ser un texto',
            'nombre_conductor.max' => 'El nombre del conductor debe tener maximo 255 caracteres',
            'cedula_conductor.string' => 'La cedula del conductor debe ser un texto',
            'cedula_conductor.max' => 'La cedula del conductor debe tener maximo 255 caracteres',
            'placa_vehiculo.string' => 'La placa del vehiculo debe ser un texto',
            'placa_vehiculo.max' => 'La placa del vehiculo debe tener maximo 255 caracteres',
            'creado_por.required' => 'El usuario que crea el registro es requerido',
            'creado_por.integer' => 'El usuario que crea el registro debe ser un numero',
            'actualizado_por.required' => 'El usuario que actualiza el registro es requerido',
            'actualizado_por.integer' => 'El usuario que actualiza el registro debe ser un numero',
        ];
    }
}
