<?php

namespace App\Http\Resources\InformacionVapor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformacionVaporResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vapor' => $this->vapor,
            'remision_origen' => $this->remision_origen,
            'peso_segun_puerto' => $this->peso_segun_puerto,
            'unidad_medida_segun_puerto' => $this->unidad_medida,
        ];
    }
}
