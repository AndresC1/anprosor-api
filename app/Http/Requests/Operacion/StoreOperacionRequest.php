<?php

namespace App\Http\Requests\Operacion;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class StoreOperacionRequest extends FormRequest
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
        $service_almacenamiento_id = Service::where('name', 'Almacenamiento')->first()->id;
        return [
            'movimiento' => 'required|string|in:remision,ingreso',
            'estado' => 'required|string|in:en_proceso,finalizado,cancelada',
            'numero_documento' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i:s',
            'hora_salida' => 'date_format:H:i:s|nullable|required_if:estado,finalizado',
            'nombre_conductor' => 'string|max:255|nullable',
            'cedula_conductor' => 'string|max:255|nullable',
            'placa_vehiculo' => 'string|max:255|nullable',
            'observaciones' => 'string|max:255|nullable',
            // Detalles operacion
            'detalles_operacion' => 'array',
            'detalles_operacion.*.origen' => 'string|required|in:barco,campo',
            'detalles_operacion.*.presentacion' => 'string|required|in:granel,saco',
            'detalles_operacion.*.observacion_operacion' => 'string|nullable',
            'detalles_operacion.*.servicio_id' => 'integer|required|exists:services,id',
            'detalles_operacion.*.silo_id' => 'integer|nullable|min:0|exists:silos,id|required_if:detalles_operacion.*.servicio_id,'.$service_almacenamiento_id,
            'detalles_operacion.*.producto_id' => 'integer|nullable|exists:grains,id|required',
            // Informacion vapor
            'detalles_operacion.*.vapor' => 'string|required_if:detalles_operacion.*.origen,barco|nullable',
            'detalles_operacion.*.remision_origen' => 'string|required_if:detalles_operacion.*.origen,barco|nullable',
            'detalles_operacion.*.peso_segun_puerto' => 'numeric|nullable|required_if:detalles_operacion.*.origen,barco',
            'detalles_operacion.*.UM_segun_puerto' => 'string|in:kg,qq,ton|nullable|required_if:detalles_operacion.*.origen,barco',
            // Analisis
            'detalles_operacion.*.temperatura' => 'numeric|min:0|max:999|required_if:estado,finalizado',
            'detalles_operacion.*.humedad' => 'numeric|min:0|max:9999|required_if:estado,finalizado',
            'detalles_operacion.*.impurezas' => 'numeric|min:0|max:9999|required_if:estado,finalizado',
            'detalles_operacion.*.grano_quebrado' => 'integer|min:0|required_if:estado,finalizado',
            'detalles_operacion.*.grano_no_desarrollado' => 'integer|min:0|required_if:estado,finalizado',
            'detalles_operacion.*.hongo' => 'integer|min:0|required_if:estado,finalizado',
            // Pesaje
            'detalles_operacion.*.peso_bruto' => 'numeric|min:0|max:99999999|nullable|required_if:estado,finalizado',
            'detalles_operacion.*.peso_tara' => 'numeric|min:0|max:99999999|nullable|required_if:estado,finalizado',
            'detalles_operacion.*.peso_neto' => 'numeric|min:0|max:99999999|nullable|required_if:estado,finalizado',
            'detalles_operacion.*.unidad_medida_peso' => 'string|in:kg,qq,ton|nullable|required',
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
            'fecha_registro.required' => 'La fecha de registro es requerida',
            'fecha_registro.date' => 'La fecha de registro debe ser una fecha',
            'hora_entrada.required' => 'La hora de entrada es requerida',
            'hora_entrada.date_format' => 'La hora de entrada debe ser una hora',
            'hora_salida.date_format' => 'La hora de salida debe ser una hora',
            'nombre_conductor.string' => 'El nombre del conductor debe ser un texto',
            'nombre_conductor.max' => 'El nombre del conductor debe tener maximo 255 caracteres',
            'cedula_conductor.string' => 'La cedula del conductor debe ser un texto',
            'cedula_conductor.max' => 'La cedula del conductor debe tener maximo 255 caracteres',
            'placa_vehiculo.string' => 'La placa del vehiculo debe ser un texto',
            'placa_vehiculo.max' => 'La placa del vehiculo debe tener maximo 255 caracteres',
            'creado_por.required' => 'El usuario que crea el registro es requerido',
            'creado_por.integer' => 'El usuario que crea el registro debe ser un numero',
            'creado_por.exists' => 'El usuario que crea el registro debe existir en la base de datos',
            'actualizado_por.required' => 'El usuario que actualiza el registro es requerido',
            'actualizado_por.integer' => 'El usuario que actualiza el registro debe ser un numero',
            'actualizado_por.exists' => 'El usuario que actualiza el registro debe existir en la base de datos',
            'observaciones.string' => 'Las observaciones deben ser un texto',
            'observaciones.max' => 'Las observaciones deben tener maximo 255 caracteres',
            'movimiento.required' => 'El movimiento es requerido',
            'movimiento.string' => 'El movimiento debe ser un texto',
            'movimiento.in' => 'El movimiento debe ser remision o ingreso',
            'estado.required' => 'El estado es requerido',
            'estado.string' => 'El estado debe ser un texto',
            'estado.in' => 'El estado debe ser en_proceso o finalizado',
            'detalles_operacion.array' => 'detalles_operacion debe de ser un array',
            'detalles_operacion.*.origen.string' => 'El origen debe ser un texto',
            'detalles_operacion.*.origen.required' => 'El origen es requerido',
            'detalles_operacion.*.origen.in' => 'El origen debe ser barco o campo',
            'detalles_operacion.*.presentacion.string' => 'La presentacion debe ser un texto',
            'detalles_operacion.*.presentacion.required' => 'La presentacion es requerida',
            'detalles_operacion.*.presentacion.in' => 'La presentacion debe ser granel o saco',
            'detalles_operacion.*.observacion_operacion.string' => 'La observacion de la operacion debe ser un texto',
            'detalles_operacion.*.servicio_id.integer' => 'El servicio debe ser un numero',
            'detalles_operacion.*.servicio_id.required' => 'El servicio es requerido',
            'detalles_operacion.*.servicio_id.exists' => 'El servicio debe existir en la base de datos',
            'detalles_operacion.*.silo_id.integer' => 'El silo debe ser un numero',
            'detalles_operacion.*.silo_id.required_if' => 'El silo es requerido si el servicio es almacenamiento',
            'detalles_operacion.*.silo_id.exists' => 'El silo debe existir en la base de datos',
            'detalles_operacion.*.producto_id.integer' => 'El producto debe ser un numero',
            'detalles_operacion.*.producto_id.required' => 'El producto es requerido',
            'detalles_operacion.*.producto_id.exists' => 'El producto debe existir en la base de datos',
            'detalles_operacion.*.vapor.string' => 'El vapor debe ser un texto',
            'detalles_operacion.*.vapor.required_if' => 'El vapor es requerido si el origen es barco',
            'detalles_operacion.*.remision_origen.string' => 'La remision de origen debe ser un texto',
            'detalles_operacion.*.remision_origen.required_if' => 'La remision de origen es requerida si el origen es barco',
            'detalles_operacion.*.peso_segun_puerto.numeric' => 'El peso segun puerto debe ser un numero',
            'detalles_operacion.*.peso_segun_puerto.required_if' => 'El peso segun puerto es requerido si el origen es barco',
            'detalles_operacion.*.UM_segun_puerto.string' => 'La unidad de medida segun puerto debe ser un texto',
            'detalles_operacion.*.UM_segun_puerto.in' => 'La unidad de medida segun puerto debe ser kg, qq o ton',
            'detalles_operacion.*.UM_segun_puerto.required_if' => 'La unidad de medida segun puerto es requerida si el origen es barco',
            'detalles_operacion.*.temperatura.numeric' => 'La temperatura debe ser un numero',
            'detalles_operacion.*.temperatura.min' => 'La temperatura debe ser mayor o igual a 0',
            'detalles_operacion.*.temperatura.max' => 'La temperatura debe ser menor o igual a 999',
            'detalles_operacion.*.humedad.numeric' => 'La humedad debe ser un numero',
            'detalles_operacion.*.humedad.min' => 'La humedad debe ser mayor o igual a 0',
            'detalles_operacion.*.humedad.max' => 'La humedad debe ser menor o igual a 9999',
            'detalles_operacion.*.impurezas.numeric' => 'Las impurezas deben ser un numero',
            'detalles_operacion.*.impurezas.min' => 'Las impurezas deben ser mayor o igual a 0',
            'detalles_operacion.*.impurezas.max' => 'Las impurezas deben ser menor o igual a 9999',
            'detalles_operacion.*.grano_quebrado.integer' => 'El grano quebrado debe ser un numero',
            'detalles_operacion.*.grano_quebrado.min' => 'El grano quebrado debe ser mayor o igual a 0',
            'detalles_operacion.*.grano_no_desarrollado.integer' => 'El grano no desarrollado debe ser un numero',
            'detalles_operacion.*.grano_no_desarrollado.min' => 'El grano no desarrollado debe ser mayor o igual a 0',
            'detalles_operacion.*.hongo.integer' => 'El hongo debe ser un numero',
            'detalles_operacion.*.hongo.min' => 'El hongo debe ser mayor o igual a 0',
            'detalles_operacion.*.peso_bruto.numeric' => 'El peso bruto debe ser un numero',
            'detalles_operacion.*.peso_bruto.min' => 'El peso bruto debe ser mayor o igual a 0',
            'detalles_operacion.*.peso_bruto.max' => 'El peso bruto debe ser menor o igual a 99999999',
            'detalles_operacion.*.peso_tara.numeric' => 'El peso tara debe ser un numero',
            'detalles_operacion.*.peso_tara.min' => 'El peso tara debe ser mayor o igual a 0',
            'detalles_operacion.*.peso_tara.max' => 'El peso tara debe ser menor o igual a 99999999',
            'detalles_operacion.*.peso_neto.numeric' => 'El peso neto debe ser un numero',
            'detalles_operacion.*.peso_neto.min' => 'El peso neto debe ser mayor o igual a 0',
            'detalles_operacion.*.peso_neto.max' => 'El peso neto debe ser menor o igual a 99999999',
            'detalles_operacion.*.unidad_medida_peso.string' => 'La unidad de medida de peso debe ser un texto',
            'detalles_operacion.*.unidad_medida_peso.in' => 'La unidad de medida de peso debe ser kg, qq o ton',
            'detalles_operacion.*.unidad_medida_peso.required' => 'La unidad de medida de peso es requerida',
            'detalles_operacion.*.peso_bruto.required_if' => 'El peso bruto es requerido si el estado es finalizado',
            'detalles_operacion.*.peso_tara.required_if' => 'El peso tara es requerido si el estado es finalizado',
            'detalles_operacion.*.peso_neto.required_if' => 'El peso neto es requerido si el estado es finalizado',
            'detalles_operacion.*.temperatura.required_if' => 'La temperatura es requerida si el estado es finalizado',
            'detalles_operacion.*.humedad.required_if' => 'La humedad es requerida si el estado es finalizado',
            'detalles_operacion.*.impurezas.required_if' => 'Las impurezas son requeridas si el estado es finalizado',
            'detalles_operacion.*.grano_quebrado.required_if' => 'El grano quebrado es requerido si el estado es finalizado',
            'detalles_operacion.*.grano_no_desarrollado.required_if' => 'El grano no desarrollado es requerido si el estado es finalizado',
            'detalles_operacion.*.hongo.required_if' => 'El hongo es requerido si el estado es finalizado',
        ];
    }
}
