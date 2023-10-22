<?php

namespace App\Http\Requests\Remission;

use Illuminate\Foundation\Http\FormRequest;

class FinishRemissionRequest extends FormRequest
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
            'remision_origen' => 'string|min:1|max:20|nullable',
            'vapor' => 'string|min:1|max:100|nullable',
            'peso_segun_puerto' => 'numeric|min:0|nullable',
            'silo_id' => 'integer|exists:silos,id|min:1|nullable',
            'temperatura' => 'numeric|min:0|required',
            'humedad' => 'numeric|min:0|required',
            'impureza' => 'numeric|min:0|required',
            'grano_quebrado' => 'numeric|min:0|required',
            'grano_no_desarrollado' => 'numeric|min:0|required',
            'peso_tara' => 'numeric|min:0|required',
            'peso_neto' => 'numeric|min:0|required',
            'observaciones' => 'string|min:1|max:255|nullable',
            'remision_general_xlsx' => 'string|min:1|max:255|nullable',
            'recibo_ingreso_xlsx' => 'string|min:1|max:255|nullable',
            'recibo_egreso_xlsx' => 'string|min:1|max:255|nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'remision_origen.string' => 'El campo remision_origen debe ser un texto.',
            'remision_origen.min' => 'El campo remision_origen debe tener al menos :min caracteres.',
            'remision_origen.max' => 'El campo remision_origen no debe ser mayor a :max caracteres.',
            'vapor.string' => 'El campo vapor debe ser un texto.',
            'vapor.min' => 'El campo vapor debe tener al menos :min caracteres.',
            'vapor.max' => 'El campo vapor no debe ser mayor a :max caracteres.',
            'peso_segun_puerto.numeric' => 'El campo peso_segun_puerto debe ser un número.',
            'peso_segun_puerto.min' => 'El campo peso_segun_puerto debe ser mínimo :min.',
            'silo_id.integer' => 'El campo silo_id debe ser un número entero.',
            'silo_id.exists' => 'El campo silo_id debe existir en la tabla silos.',
            'silo_id.min' => 'El campo silo_id debe ser mínimo :min.',
            'silo_id.required' => 'El campo silo_id es requerido.',
            'temperatura.numeric' => 'El campo temperatura debe ser un número.',
            'temperatura.min' => 'El campo temperatura debe ser mínimo :min.',
            'temperatura.required' => 'El campo temperatura es requerido.',
            'humedad.numeric' => 'El campo humedad debe ser un número.',
            'humedad.min' => 'El campo humedad debe ser mínimo :min.',
            'humedad.required' => 'El campo humedad es requerido.',
            'impureza.numeric' => 'El campo impureza debe ser un número.',
            'impureza.min' => 'El campo impureza debe ser mínimo :min.',
            'impureza.required' => 'El campo impureza es requerido.',
            'grano_quebrado.numeric' => 'El campo grano_quebrado debe ser un número.',
            'grano_quebrado.min' => 'El campo grano_quebrado debe ser mínimo :min.',
            'grano_quebrado.required' => 'El campo grano_quebrado es requerido.',
            'gramo_no_desarrollado.numeric' => 'El campo grano_no_desarrollado debe ser un número.',
            'gramo_no_desarrollado.min' => 'El campo grano_no_desarrollado debe ser mínimo :min.',
            'gramo_no_desarrollado.required' => 'El campo grano_no_desarrollado es requerido.',
            'peso_tara.numeric' => 'El campo peso_tara debe ser un número.',
            'peso_tara.min' => 'El campo peso_tara debe ser mínimo :min.',
            'peso_tara.required' => 'El campo peso_tara es requerido.',
            'peso_neto.numeric' => 'El campo peso_neto debe ser un número.',
            'peso_neto.min' => 'El campo peso_neto debe ser mínimo :min.',
            'peso_neto.required' => 'El campo peso_neto es requerido.',
            'observaciones.string' => 'El campo observaciones debe ser un texto.',
            'observaciones.min' => 'El campo observaciones debe tener al menos :min caracteres.',
            'observaciones.max' => 'El campo observaciones no debe ser mayor a :max caracteres.',
            'remision_general_xlsx.string' => 'El campo remision_general_xlsx debe ser un texto.',
            'remision_general_xlsx.min' => 'El campo remision_general_xlsx debe tener al menos :min caracteres.',
            'remision_general_xlsx.max' => 'El campo remision_general_xlsx no debe ser mayor a :max caracteres.',
            'recibo_ingreso_xlsx.string' => 'El campo recibo_ingreso_xlsx debe ser un texto.',
            'recibo_ingreso_xlsx.min' => 'El campo recibo_ingreso_xlsx debe tener al menos :min caracteres.',
            'recibo_ingreso_xlsx.max' => 'El campo recibo_ingreso_xlsx no debe ser mayor a :max caracteres.',
            'recibo_egreso_xlsx.string' => 'El campo recibo_egreso_xlsx debe ser un texto.',
            'recibo_egreso_xlsx.min' => 'El campo recibo_egreso_xlsx debe tener al menos :min caracteres.',
            'recibo_egreso_xlsx.max' => 'El campo recibo_egreso_xlsx no debe ser mayor a :max caracteres.',
        ];
    }
}
