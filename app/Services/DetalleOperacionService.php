<?php

namespace App\Services;

use App\Repository\DetalleOperacionRepository;
use Illuminate\Http\Request;

class DetalleOperacionService
{
    private $detalleOperacionRepository;

    public function __construct()
    {
        $this->detalleOperacionRepository = new DetalleOperacionRepository();
    }

    public function store(Request $request, array $otherDatas): int
    {
        $data = $this->destructure($request);
        $data = array_merge($data, $otherDatas);
        return $this->detalleOperacionRepository->store($data);
    }

    public function destructure(Request $request): array{
        return [
            'origen' => $request->origen,
            'presentacion' => $request->presentacion,
            'observacion' => $request->observacion,
        ] = $request->all();
    }
}
