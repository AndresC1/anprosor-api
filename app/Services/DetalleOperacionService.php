<?php

namespace App\Services;

use App\Models\Service;
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
        $data = [
            'servicio_id' => $request->servicio_id,
            'origen' => $request->origen,
            'producto_id' => $request->producto_id,
            'presentacion' => $request->presentacion,
        ] = $request->all();
        $newDatas = [
            'silo_id' => $this->ValidateServiceSilo($request),
            'observacion' => $request->observacion_operacion
        ];
        $data = array_merge($data, $newDatas);
        return $data;
    }

    public function ValidateServiceSilo(Request $request): int|null{
        $almacenamientoID = Service::where('name', 'Almacenamiento')->first()->id;
        if($request->servicio_id === $almacenamientoID){
            return $request->silo_id;
        }
        return null;
    }
}
