<?php

namespace App\Http\Requests\Remission;

use Illuminate\Foundation\Http\FormRequest;

class StoreRemissionRequest extends FormRequest
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
            'numero_remision' => 'required|string|min:1|max:8|unique:remissions,numero_remision',
            'remision_origen' => 'string|min:1|max:20|nullable',
            'cliente' => 'required|string|min:1|max:150',
            'servicio_id' => 'required|numeric|exists:services,id|min:1',
            'vapor' => 'string|min:1|max:100|nullable',
            'peso_segun_puerto' => 'numeric|min:0|nullable',
            'silo_id' => 'integer|exists:silos,id|min:1|nullable',
            'presentacion' => 'required|string|min:1|max:100',
            'producto' => 'required|integer|exists:grains,id|min:1',
            'unidad_medida' => 'required|string|min:1|max:3|in:kg,qq,ton',
            'temperatura' => 'numeric|min:0|nullable',
            'humedad' => 'numeric|min:0|nullable',
            'impureza' => 'numeric|min:0|nullable',
            'grano_quebrado' => 'numeric|min:0|nullable',
            'grano_no_desarrollado' => 'numeric|min:0|nullable',
            'conductor' => 'required|string|min:1|max:150',
            'placa' => 'required|string|min:1|max:14',
            'cedula_conductor' => 'required|string|min:1|max:20',
            'peso_bruto' => 'required|numeric|min:0',
            'peso_tara' => 'numeric|min:0|nullable',
            'peso_neto' => 'numeric|min:0|nullable',
            'movimiento' => 'required|string|in:ingreso,egreso',
            'observaciones' => 'string|min:1|max:255|nullable',
            'estado' => 'required|string|in:completado,en_curso',
            'remision_general_xlsx' => 'string|min:1|max:255|nullable',
            'recibo_ingreso_xlsx' => 'string|min:1|max:255|nullable',
            'recibo_egreso_xlsx' => 'string|min:1|max:255|nullable',
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
            'numero_remision.required' => 'El número de remisión es requerido',
            'numero_remision.string' => 'El número de remisión debe ser una cadena de caracteres',
            'numero_remision.min' => 'El número de remisión debe tener al menos :min caracteres',
            'numero_remision.max' => 'El número de remisión no debe tener más de :max caracteres',
            'fecha_remision.required' => 'La fecha de remisión es requerida',
            'fecha_remision.date' => 'La fecha de remisión debe ser una fecha válida',
            'remision_origen.string' => 'La remisión origen debe ser una cadena de caracteres',
            'remision_origen.min' => 'La remisión origen debe tener al menos :min caracteres',
            'remision_origen.max' => 'La remisión origen no debe tener más de :max caracteres',
            'cliente.required' => 'El cliente es requerido',
            'cliente.string' => 'El cliente debe ser una cadena de caracteres',
            'cliente.min' => 'El cliente debe tener al menos :min caracteres',
            'cliente.max' => 'El cliente no debe tener más de :max caracteres',
            'servicio_id.required' => 'El servicio es requerido',
            'servicio_id.integer' => 'El servicio debe ser un número entero',
            'servicio_id.exists' => 'El servicio seleccionado no existe',
            'servicio_id.min' => 'El servicio debe ser un número entero positivo',
            'vapor.string' => 'El vapor debe ser una cadena de caracteres',
            'vapor.min' => 'El vapor debe tener al menos :min caracteres',
            'vapor.max' => 'El vapor no debe tener más de :max caracteres',
            'creado_por.required' => 'El usuario que crea la remisión es requerido',
            'creado_por.integer' => 'El usuario que crea la remisión debe ser un número entero',
            'creado_por.exists' => 'El usuario que crea la remisión seleccionado no existe',
            'creado_por.min' => 'El usuario que crea la remisión debe ser un número entero positivo',
            'ultima_modificacion_por.integer' => 'El usuario que modifica la remisión debe ser un número entero',
            'ultima_modificacion_por.exists' => 'El usuario que modifica la remisión seleccionado no existe',
            'ultima_modificacion_por.min' => 'El usuario que modifica la remisión debe ser un número entero positivo',
            'silo_id.integer' => 'El silo debe ser un número entero',
            'silo_id.exists' => 'El silo seleccionado no existe',
            'silo_id.min' => 'El silo debe ser un número entero positivo',
            'presentacion.required' => 'La presentación es requerida',
            'presentacion.string' => 'La presentación debe ser una cadena de caracteres',
            'presentacion.min' => 'La presentación debe tener al menos :min caracteres',
            'presentacion.max' => 'La presentación no debe tener más de :max caracteres',
            'producto.required' => 'El producto es requerido',
            'producto.integer' => 'El producto debe ser un número entero',
            'producto.exists' => 'El producto seleccionado no existe',
            'producto.min' => 'El producto debe ser un número entero positivo',
            'unidad_medida.required' => 'La unidad de medida es requerida',
            'unidad_medida.string' => 'La unidad de medida debe ser una cadena de caracteres',
            'unidad_medida.min' => 'La unidad de medida debe tener al menos :min caracteres',
            'unidad_medida.max' => 'La unidad de medida no debe tener más de :max caracteres',
            'temperatura.numeric' => 'La temperatura debe ser un número',
            'temperatura.min' => 'La temperatura debe ser un número positivo',
            'humedad.numeric' => 'La humedad debe ser un número',
            'humedad.min' => 'La humedad debe ser un número positivo',
            'impureza.numeric' => 'La impureza debe ser un número',
            'impureza.min' => 'La impureza debe ser un número positivo',
            'grano_quebrado.numeric' => 'El grano quebrado debe ser un número',
            'grano_quebrado.min' => 'El grano quebrado debe ser un número positivo',
            'grano_no_desarrollado.numeric' => 'El grano no desarrollado debe ser un número',
            'grano_no_desarrollado.min' => 'El grano no desarrollado debe ser un número positivo',
            'conductor.required' => 'El conductor es requerido',
            'conductor.string' => 'El conductor debe ser una cadena de caracteres',
            'conductor.min' => 'El conductor debe tener al menos :min caracteres',
            'conductor.max' => 'El conductor no debe tener más de :max caracteres',
            'placa.required' => 'La placa es requerida',
            'placa.string' => 'La placa debe ser una cadena de caracteres',
            'placa.min' => 'La placa debe tener al menos 1 caracteres',
            'placa.max' => 'La placa no debe tener más de 20 caracteres',
            'cedula_conductor.required' => 'La cédula del conductor es requerida',
            'cedula_conductor.string' => 'La cédula del conductor debe ser una cadena de caracteres',
            'cedula_conductor.min' => 'La cédula del conductor debe tener al menos :min caracteres',
            'cedula_conductor.max' => 'La cédula del conductor no debe tener más de :max caracteres',
            'peso_bruto.required' => 'El peso bruto es requerido',
            'peso_bruto.numeric' => 'El peso bruto debe ser un número',
            'peso_bruto.min' => 'El peso bruto debe ser un número positivo',
            'peso_tara.numeric' => 'El peso tara debe ser un número',
            'peso_tara.min' => 'El peso tara debe ser un número positivo',
            'peso_neto.numeric' => 'El peso neto debe ser un número',
            'peso_neto.min' => 'El peso neto debe ser un número positivo',
            'movimiento.required' => 'El movimiento es requerido',
            'movimiento.string' => 'El movimiento debe ser una cadena de caracteres',
            'movimiento.in' => 'El movimiento seleccionado no es válido',
            'observaciones.string' => 'Las observaciones deben ser una cadena de caracteres',
            'observaciones.min' => 'Las observaciones deben tener al menos :min caracteres',
            'observaciones.max' => 'Las observaciones no deben tener más de :max caracteres',
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser una cadena de caracteres',
            'estado.in' => 'El estado seleccionado no es válido',
            'remision_general_xlsx.string' => 'El nombre del archivo de la remisión general debe ser una cadena de caracteres',
            'remision_general_xlsx.min' => 'El nombre del archivo de la remisión general debe tener al menos :min caracteres',
            'remision_general_xlsx.max' => 'El nombre del archivo de la remisión general no debe tener más de :max caracteres',
            'recibo_ingreso_xlsx.string' => 'El nombre del archivo del recibo de ingreso debe ser una cadena de caracteres',
            'recibo_ingreso_xlsx.min' => 'El nombre del archivo del recibo de ingreso debe tener al menos :min caracteres',
            'recibo_ingreso_xlsx.max' => 'El nombre del archivo del recibo de ingreso no debe tener más de :max caracteres',
            'recibo_egreso_xlsx.string' => 'El nombre del archivo del recibo de egreso debe ser una cadena de caracteres',
            'recibo_egreso_xlsx.min' => 'El nombre del archivo del recibo de egreso debe tener al menos :min caracteres',
            'recibo_egreso_xlsx.max' => 'El nombre del archivo del recibo de egreso no debe tener más de :max caracteres',
        ];
    }
}
