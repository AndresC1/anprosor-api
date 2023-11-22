<?php

namespace App\Http\Resources\Remission;

use App\Http\Resources\Client\InfoClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoRemissionResource extends JsonResource
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
            'cliente' => $this->client_id?Client::find($this->client_id)->select('name')->first():null,
            'fecha_remision' => $this->fecha_remision,
            'hora_entrada' => $this->hora_entrada,
            'hora_salida' => $this->hora_salida,
        ];
    }
}
