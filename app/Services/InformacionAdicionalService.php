<?php

namespace App\Services;

use App\Repository\InformacionAdicionalRepository;
use Illuminate\Http\Request;

class InformacionAdicionalService
{
    private $informacionAdicionalRepository;
    public function __construct()
    {
        $this->informacionAdicionalRepository = new InformacionAdicionalRepository();
    }

    public function store(Request $request): int
    {
        $data = $this->destructure($request);
        return $this->informacionAdicionalRepository->store($data);
    }

    public function destructure($request): array{
        return [
            'creado_por' => auth()->user()->id,
            'actualizado_por' => auth()->user()->id,
            'observaciones' => $request->observaciones,
        ];
    }
}
