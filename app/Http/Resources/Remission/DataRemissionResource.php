<?php

namespace App\Http\Resources\Remission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataRemissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero_remision' => $this->numero_remision,
            'fecha_remision' => $this->fecha_remision,
            'remision_origen' => $this->remision_origen,
            'hora_entrada' => $this->hora_entrada,
            'hora_salida' => $this->hora_salida,
            'cliente' => $this->cliente,
            'servicio_id' => $this->servicio_id,
            'vapor' => $this->vapor,
            'creado_por' => $this->creado_por,
            'ultima_modificacion_por' => $this->ultima_modificacion_por,
            'silo_id' => $this->silo_id,
            'presentacion' => $this->presentacion,
            'producto' => $this->producto,
            'unidad_medida' => $this->unidad_medida,
            'temperatura' => $this->temperatura,
            'humedad' => $this->humedad,
            'impureza' => $this->impureza,
            'grano_quebrado' => $this->grano_quebrado,
            'grano_no_desarrollado' => $this->grano_no_desarrollado,
            'conductor' => $this->conductor,
            'placa' => $this->placa,
            'cedula_conductor' => $this->cedula_conductor,
            'peso_bruto' => $this->peso_bruto,
            'peso_tara' => $this->peso_tara,
            'peso_neto' => $this->peso_neto,
            'movimiento' => $this->movimiento,
            'observaciones' => $this->observaciones,
            'estado' => $this->estado,
            'remision_general_xlsx' => $this->remision_general_xlsx,
            'recibo_ingreso_xlsx' => $this->recibo_ingreso_xlsx,
            'recibo_egreso_xlsx' => $this->recibo_egreso_xlsx,
        ];
    }
}
