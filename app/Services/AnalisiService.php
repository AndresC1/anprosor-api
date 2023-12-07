<?php

namespace App\Services;

use App\Repository\AnalisiRepository;
use Illuminate\Http\Request;

class AnalisiService
{
    private $analisiRepository;
    public function __construct(){
        $this->analisiRepository = new AnalisiRepository();
    }

    public function store(Request $request): int
    {
        $data = $this->destructure($request);
        return $this->analisiRepository->store($data);
    }

    public function destructure(Request $request): array{
        return [
            'temperatura' => $request->temperatura,
            'humedad' => $request->humedad,
            'impurezas' => $request->impurezas,
            'grano_quebrado' => $request->grano_quebrado,
            'grano_no_desarrollado' => $request->grano_no_desarrollado,
            'hongo' => $request->hongo,
        ] = $request->all();
    }
}
