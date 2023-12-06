<?php

namespace App\Services;

use App\Repository\OperationRepository;

class OperationService
{
    private $datosGeneralesService;
    private $informacionAdicionalService;
    private $operationRepository;
    public function __construct()
    {
        $this->datosGeneralesService = new DatosGeneralesService();
        $this->informacionAdicionalService = new InformacionAdicionalService();
        $this->operationRepository = new OperationRepository();
    }

    public function register($request)
    {
        $datosGeneralesId = $this->datosGeneralesService->store($request);
        $informacionAdicionalId = $this->informacionAdicionalService->store($request);
        $this->store($request, [
            'datos_generales_id' => $datosGeneralesId,
            'informacion_adicional_id' => $informacionAdicionalId,
        ]);
    }

    protected function store($request, array $details)
    {
        $requestDestructured = $this->destructure($request);
        $data = array_merge($requestDestructured, $details);
        return $this->operationRepository->store($data);
    }

    protected function destructure($request): array
    {
        return [
            'estado' => $estado,
            'movimiento' => $movimiento,
        ] = $request->all();
    }
}
