<?php

namespace App\Repository;

use App\Models\DatosGenerales;

class DatosGeneralesRepository
{
    public function store(array $data): int{
        $NewDatosGenerales = DatosGenerales::create($data);
        return $NewDatosGenerales->id;
    }
}
