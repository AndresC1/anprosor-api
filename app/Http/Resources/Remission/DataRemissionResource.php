<?php

namespace App\Http\Resources\Remission;

use App\Http\Resources\Client\InfoClientResource;
use App\Http\Resources\Grains\InfoGrainResource;
use App\Http\Resources\Service\InfoServiceResource;
use App\Http\Resources\Silo\InfoSiloResource;
use App\Http\Resources\User\InfoCleanUserResource;
use App\Models\Client;
use App\Models\Grains;
use App\Models\Service;
use App\Models\Silo;
use App\Models\User;
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
            'cliente' => $this->client_id?InfoClientResource::make(Client::find($this->client_id)->first()):null,
            'servicio_id' => $this->servicio_id?InfoServiceResource::make(Service::find($this->servicio_id)->first()):null,
            'vapor' => $this->vapor,
            'creado_por' => $this->creado_por?InfoCleanUserResource::class::make(User::find($this->creado_por)->first()):null,
            'ultima_modificacion_por' => $this->ultima_modificacion_por?InfoCleanUserResource::class::make(User::find($this->ultima_modificacion_por)->first()):null,
            'silo_id' => $this->silo_id?InfoSiloResource::make(Silo::find($this->silo_id)->first()):null,
            'presentacion' => $this->presentacion,
            'producto' => $this->producto?InfoGrainResource::make(Grains::find($this->producto)->first()):null,
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
