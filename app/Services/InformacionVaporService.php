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

    public function destructure(Request $request): array{
        $data = [
            'vapor' => $request->vapor,
            'remision_origen' => $request->remision_origen,
            'peso_segun_puerto' => $request->peso_segun_puerto,
        ] = $request->all();
        $UM_segun_puerto = ["unidad_medida" => $request->UM_segun_puerto];
        $data = array_merge($data, $UM_segun_puerto);
        return $data;
    }
}
