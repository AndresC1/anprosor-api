<?php

namespace App\Http\Resources\Archivo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'PDF' => $this->PDF,
            'Excel' => $this->Excel,
        ];
    }
}
