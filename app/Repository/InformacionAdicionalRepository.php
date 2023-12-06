<?php

namespace App\Repository;

use App\Models\InformacionAdicional;

class InformacionAdicionalRepository
{
    public function store(array $data): int{
        $NewInformacionAdicional = InformacionAdicional::create($data);
        return $NewInformacionAdicional->id;
    }
}
