<?php

namespace App\Services;

use App\Models\DatosGenerales;
use App\Repository\DatosGeneralesRepository;
use Illuminate\Http\Request;

class DatosGeneralesService
{
    private $datosGeneralesRepository;
    public function __construct()
    {
        $this->datosGeneralesRepository = new DatosGeneralesRepository();
    }

    public function store(Request $request): int
    {
        $data = $this->destructure($request);
        return $this->datosGeneralesRepository->store($data);
    }

    public function destructure($request): array{
        return [
            'numero_documento' => $numero_documento,
            'fecha_registro' => $fecha_registro,
            'hora_entrada' => $hora_entrada,
            'hora_salida' => $hora_salida,
            'nombre_conductor' => $nombre_conductor,
            'cedula_conductor' => $cedula_conductor,
            'placa_vehiculo' => $placa_vehiculo,
        ] = $request->all();
    }

    public function update(Request $request, int $datosGenerales): int
    {
        $data = $this->destructure($request);
        $infoDatosGenerales = $this->find($datosGenerales);
        return $this->datosGeneralesRepository->update($data, $infoDatosGenerales);
    }

    private function find(int $datosGeneralesId): DatosGenerales
    {
        return DatosGenerales::findOrfail($datosGeneralesId);
    }
}
