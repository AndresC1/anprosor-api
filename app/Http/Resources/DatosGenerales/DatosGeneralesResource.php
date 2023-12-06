<?php

namespace App\Http\Resources\DatosGenerales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatosGeneralesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'numero_documento' => $this->numero_documento,
            'fecha_registro' => $this->fecha_registro,
            'hora_entrada' => $this->hora_entrada,
            'hora_salida' => $this->hora_salida,
            'nombre_conductor' => $this->nombre_conductor,
            'cedula_conductor' => $this->cedula_conductor,
            'placa_vehiculo' => $this->placa_vehiculo,
        ];
    }
}
