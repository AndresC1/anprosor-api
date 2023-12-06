<?php

namespace App\Repository;

use App\Models\Operacion;

class OperationRepository
{
    public function store($data): int{
        $NewOperation = Operacion::create($data);
        return $NewOperation->id;
    }
}
