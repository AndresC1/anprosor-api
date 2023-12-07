<?php

namespace App\Services;

use App\Repository\InformacionVaporRepository;
use Illuminate\Http\Request;

class InformacionVaporService
{
    private $informacionVaporRepository;
    public function __construct()
    {
        $this->informacionVaporRepository = new InformacionVaporRepository();
    }

    public function store(Request $request): int
    {
        $data = $this->destructure($request);
        return $this->informacionVaporRepository->store($data);
    }

    public function destructure($request): array{
        return [
            'vapor' => $request->vapor,
            'remision_origen' => $request->remision_origen,
            'peso_segun_puerto' => $request->peso_segun_puerto,
            'unidad_medida' => $request->unidad_medida,
        ] = $request->all();
    }
}
