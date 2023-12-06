<?php

namespace App\Http\Resources\InformacionAdicional;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformacionAdicionalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $creado_por = User::find($this->creado_por);
        $actualizado_por = User::find($this->actualizado_por);
        return [
            'creado_por' => $creado_por->name,
            'actualizado_por' => $actualizado_por->name,
            'observaciones' => $this->observaciones,
        ];
    }
}
