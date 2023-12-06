<?php

namespace App\Repository;

use App\Models\InformacionAdicional;

class InformacionAdicionalRepository
{
    public function store(array $data): int{
        $NewInformacionAdicional = InformacionAdicional::create($data);
        return $NewInformacionAdicional->id;
    }

    public function update($data, InformacionAdicional $informacionAdicional): int{
        $informacionAdicional->update($data);
        return $informacionAdicional->id;
    }
}
