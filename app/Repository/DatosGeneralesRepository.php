<?php

namespace App\Repository;

use App\Models\DatosGenerales;

class DatosGeneralesRepository
{
    public function store(array $data): int{
        $NewDatosGenerales = DatosGenerales::create($data);
        return $NewDatosGenerales->id;
    }

    public function update($data, DatosGenerales $datosGenerales): int{
        $datosGenerales->update($data);
        return $datosGenerales->id;
    }
}
