<?php

namespace App\Http\Resources\DetalleOperacion;

use App\Http\Resources\Analisis\AnalisisResource;
use App\Http\Resources\Grains\InfoGrainResource;
use App\Http\Resources\InformacionVapor\InformacionVaporResource;
use App\Http\Resources\Pesaje\PesajeResource;
use App\Http\Resources\Service\InfoServiceResource;
use App\Http\Resources\Silo\InfoSiloResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetalleOperacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'servicio' => new InfoServiceResource($this->servicio),
            'origen' => $this->origen,
            'Informacion_vapor' => new InformacionVaporResource($this->informacionVapor),
            'silo' => new InfoSiloResource($this->silo),
            'producto' => new InfoGrainResource($this->producto),
            'presentacion' => $this->presentacion,
            'analisis' => new AnalisisResource($this->analisis),
            'pesaje' => new PesajeResource($this->pesaje),
            'observacion' => $this->observacion,
        ];
    }
}
