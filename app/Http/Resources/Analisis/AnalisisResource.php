<?php

namespace App\Http\Resources\Analisis;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalisisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'temperatura' => $this->temperatura,
            'humedad' => $this->humedad,
            'impurezas' => $this->impurezas,
            'grano_quebrado' => $this->grano_quebrado,
            'grano_no_desarrollado' => $this->grano_no_desarrollado,
            'hongo' => $this->hongo,
        ];
    }
}
