<?php

namespace App\Repository;

use App\Models\Pesaje;

class PesajeRepository
{
    public function store(array $data): int
    {
        $newPesaje = Pesaje::create($data);
        return $newPesaje->id;
    }
}
