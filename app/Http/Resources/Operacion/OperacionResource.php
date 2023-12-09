<?php

namespace App\Http\Resources\Operacion;

use App\Http\Resources\DatosGenerales\DatosGeneralesResource;
use App\Http\Resources\DetalleOperacion\DetalleOperacionResource;
use App\Http\Resources\InformacionAdicional\InformacionAdicionalResource;
use App\Models\DatosGenerales;
use App\Models\InformacionAdicional;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperacionResource extends JsonResource
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
            'movimiento' => $this->movimiento,
            'datos_generales' => new DatosGeneralesResource(DatosGenerales::find($this->datos_generales_id)),
            'informacion_adicional' => new InformacionAdicionalResource(InformacionAdicional::find($this->informacion_adicional_id)),
            'detalles_operacion' => DetalleOperacionResource::collection($this->detalle_operaciones),
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
