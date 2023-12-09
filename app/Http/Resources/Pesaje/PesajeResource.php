<?php

namespace App\Http\Resources\Pesaje;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesajeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'peso_bruto' => $this->peso_bruto,
            'peso_tara' => $this->peso_tara,
            'peso_neto' => $this->peso_neto,
            'unidad_medida' => $this->unidad_medida,
        ];
    }
}
