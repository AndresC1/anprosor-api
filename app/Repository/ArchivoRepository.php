<?php

namespace App\Repository;

use App\Models\Archivo;

class ArchivoRepository
{
    public function store(array $data): int{
        $newArchivos = Archivo::create($data);
        return $newArchivos->id;
    }
}
