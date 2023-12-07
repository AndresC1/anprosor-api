<?php

namespace App\Repository;

use App\Models\InformacionVapor;

class InformacionVaporRepository
{
    public function store(array $data): int
    {
        $NewInformacionVapor = InformacionVapor::create($data);
        return $NewInformacionVapor->id;
    }
}
