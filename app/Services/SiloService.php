<?php

namespace App\Services;

use App\Models\Conversion\ConverterHandle\ConverterHandle;
use App\Models\Silo;
use App\Repository\SiloRepository;
use Illuminate\Http\Request;

class SiloService
{
    private $siloRepository;
    public function __construct()
    {
        $this->siloRepository = new SiloRepository();
    }

    public function updateWeight(Request $request, string $movement)
    {
        $data = $this->destructured($request);
        $silo = $this->siloRepository->findSilo($data['silo_id']);
        $weight = $this->converterWeight(
            $data['peso_neto'],
            $data['unidad_medida_peso'],
            $this->siloRepository->getUnitMeasure($silo)
        );
        if ($movement == 'ingreso') {
            $this->incomingWeight($silo, $weight);
        } else {
            $this->outgoingWeight($silo, $weight);
        }
    }

    private function incomingWeight(Silo $silo, float $weight): void
    {
        $this->siloRepository->ValidateIncomingWeight($silo, $weight);
        $this->siloRepository->updateIncomingWeight($silo, $weight);
    }

    private function outgoingWeight(Silo $silo, float $weight): void
    {
        $this->siloRepository->ValidateOutgoingWeight($silo, $weight);
        $this->siloRepository->updateOutgoingWeight($silo, $weight);
    }

    public function destructured(Request $request): array{
        return [
            'silo_id' => $request->silo_id,
            'unidad_medida_peso' => $request->unidad_medida_peso,
            'peso_neto' => $request->peso_neto,
        ] = $request->all();
    }

    public function converterWeight(float $amount, string $from, string $to): float{
        $converter = new ConverterHandle();
        $result = $converter->convert($amount, $from, $to);
        return $result;
    }
}
