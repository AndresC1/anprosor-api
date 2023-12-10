<?php

namespace App\Repository;

use App\Models\Silo;

class SiloRepository
{
    public function updateIncomingWeight(Silo $silo, float $weight)
    {
        $silo->current_capacity = $silo->current_capacity - $weight;
        $silo->used_capacity = $silo->used_capacity + $weight;
        $silo->save();
    }

    public function updateOutgoingWeight(Silo $silo, float $weight)
    {
        $silo->current_capacity = $silo->current_capacity + $weight;
        $silo->used_capacity = $silo->used_capacity - $weight;
        $silo->save();
    }

    public function ValidateIncomingWeight(Silo $silo, float $weight): void
    {
        if($silo->current_capacity < $weight){
            throw new \Exception('El peso ingresado es mayor a la capacidad actual del silo');
        }
    }

    public function ValidateOutgoingWeight(Silo $silo, float $weight): void
    {
        if($silo->used_capacity < $weight){
            throw new \Exception('El silo no tiene suficiente capacidad para realizar el retiro');
        }
    }

    public function getUnitMeasure(Silo $silo): string
    {
        return $silo->unit_of_measure;
    }

    public function findSilo(int $id): Silo
    {
        return Silo::findOrFail($id);
    }
}
