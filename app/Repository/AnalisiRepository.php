<?php

namespace App\Repository;

use App\Models\Analisi;

class AnalisiRepository
{
    public function store(array $data): int
    {
        $newAnalisi = Analisi::create($data);
        return $newAnalisi->id;
    }
}
