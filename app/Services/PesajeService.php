<?php

namespace App\Services;

use App\Repository\PesajeRepository;
use Illuminate\Http\Request;

class PesajeService
{
    private $pesajeRepository;
    public function __construct()
    {
        $this->pesajeRepository = new PesajeRepository();
    }

    public function store(Request $request): int
    {
        $data = $this->destructure($request);
        return $this->pesajeRepository->store($data);
    }

    public function destructure(Request $request): array
    {
        $data = [
            'peso_bruto' => $request->peso_bruto,
            'peso_tara' => $request->peso_tara,
            'peso_neto' => $request->peso_neto,
        ] = $request->all();
        $newUnidadMedida = ['unidad_medida' => $request->unidad_medida_peso];
        $data = array_merge($data, $newUnidadMedida);
        return $data;
    }
}
