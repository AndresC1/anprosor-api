<?php

namespace App\Http\Resources\Silo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoSiloResource extends JsonResource
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
            'name' => $this->name,
            'unit_of_measure' => $this->unit_of_measure,
            'capacity_total' => $this->capacity_total,
            'current_capacity' => $this->current_capacity,
            'used_capacity' => $this->used_capacity,
        ];
    }
}
