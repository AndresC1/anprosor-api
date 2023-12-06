<?php

namespace App\Http\Resources\Operacion;

use App\Models\DatosGenerales;
use App\Models\InformacionAdicional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CleanOperacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $datos_generales = DatosGenerales::find($this->datos_generales_id);
        $informacion_adicional = InformacionAdicional::find($this->informacion_adicional_id);
        return [
            'id' => $this->id,
            'movimiento' => $this->movimiento,
            'numero_documento' => $datos_generales->numero_documento,
            'fecha' => $datos_generales->fecha_registro,
            'creado_por' => User::find($informacion_adicional->creado_por)->name,
            'actualizado_por' => User::find($informacion_adicional->actualizado_por)->name,
            'estado' => $this->estado,
        ];
    }
}
