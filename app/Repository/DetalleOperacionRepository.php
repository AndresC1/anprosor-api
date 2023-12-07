<?php

namespace App\Repository;

use App\Models\DetalleOperacion;

class DetalleOperacionRepository
{
    public function store(array $data): int{
        $newDetalleOperacion = DetalleOperacion::create($data);
        return $newDetalleOperacion->id;
    }
}
