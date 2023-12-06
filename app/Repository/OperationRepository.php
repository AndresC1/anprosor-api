<?php

namespace App\Repository;

use App\Models\Operacion;

class OperationRepository
{
    public function store($data): int{
        $NewOperation = Operacion::create($data);
        return $NewOperation->id;
    }

    public function update($data, Operacion $operation): int{
        $operation->update($data);
        return $operation->id;
    }
}
