<?php

namespace App\Services;

use App\Models\Operacion;
use App\Models\Service;
use App\Repository\OperationRepository;
use Illuminate\Http\Request;

class OperationService
{
    private $datosGeneralesService;
    private $informacionAdicionalService;
    private $operationRepository;
    private $informacion_vapor;
    private $analisisService;
    private $pesajeService;
    private $detalleOperacionService;
    private $siloService;
    private $archivoService;
    public function __construct()
    {
        $this->datosGeneralesService = new DatosGeneralesService();
        $this->informacionAdicionalService = new InformacionAdicionalService();
        $this->operationRepository = new OperationRepository();
        $this->informacion_vapor = new InformacionVaporService();
        $this->analisisService = new AnalisiService();
        $this->pesajeService = new PesajeService();
        $this->detalleOperacionService = new DetalleOperacionService();
        $this->siloService = new SiloService();
        $this->archivoService = new ArchivoService();
    }

    public function register($request)
    {
        $datosGeneralesId = $this->datosGeneralesService->store($request);
        $informacionAdicionalId = $this->informacionAdicionalService->store($request);
        $operationID = $this->store($request, [
            'datos_generales_id' => $datosGeneralesId,
            'informacion_adicional_id' => $informacionAdicionalId,
        ]);
        foreach ($request->detalles_operacion as $detalle_operacion){
            $requestCreate = new Request($detalle_operacion);
            $informacionVaporID = null;
            if($detalle_operacion["origen"] == "barco"){
                $informacionVaporID = $this->informacion_vapor->store($requestCreate);
            }
            if(!$this->validate_service($requestCreate, 'Pesaje')){
                $analisisID = $this->analisisService->store($requestCreate);
            }
            $pesajeID = $this->pesajeService->store($requestCreate);
            $archivoID = $this->archivoService->store();
            $this->detalleOperacionService->store($requestCreate, [
                'operacion_id' => $operationID,
                'informacion_vapor_id' => $informacionVaporID,
                'analisis_id' => $analisisID??null,
                'pesaje_id' => $pesajeID,
                'archivos_id' => $archivoID,
            ]);
            $this->updateCapacitySilo($requestCreate, $request["movimiento"]);
        }
    }

    private function validate_service(Request $request, string $service_name): bool
    {
        $service_id = $request->servicio_id;
        return Service::where('name', $service_name)->first()->id == $service_id;
    }

    private function updateCapacitySilo(Request $request, string $movement){
        $service_id = $request->servicio_id;
        if(Service::where('name', 'Almacenamiento')->first()->id == $service_id){
            $this->siloService->updateWeight($request, $movement);
        }
    }

    protected function store($request, array $details): int
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

    public function update($request, Operacion $operation)
    {
        $requestDestructured = $this->destructure($request);
        $this->datosGeneralesService->update($request, $operation->datos_generales_id);
        $this->informacionAdicionalService->update($request, $operation->informacion_adicional_id);
        $this->operationRepository->update($requestDestructured, $operation);
    }
}
