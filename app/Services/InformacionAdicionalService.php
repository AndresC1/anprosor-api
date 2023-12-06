<?php

namespace App\Services;

use App\Models\InformacionAdicional;
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

    public function update(Request $request, int $informacionAdicional): int
    {
        $data = $this->destructure($request);
        $data = array_merge($data, [
            'actualizado_por' => auth()->user()->id,
        ]);
        $infoInformacionAdicional = $this->find($informacionAdicional);
        return $this->informacionAdicionalRepository->update($data, $infoInformacionAdicional);
    }

    public function find(int $informacionAdicionalId): InformacionAdicional
    {
        return InformacionAdicional::findOrfail($informacionAdicionalId);
    }
}
