<?php

namespace App\Repository\RemissionRepository;

use App\Http\Requests\Remission\StoreRemissionRequest;
use App\Models\Remission;

class RemissionRepository
{
    public function store(StoreRemissionRequest $request): Remission
    {
        $hora_salida = null;
        if($request->estado == 'completado'){
            $hora_salida = now('America/Managua')->format('H:i:s');
        }
        $remission = Remission::create([
            'numero_remision' => $request->numero_remision,
            'fecha_remision' => now('America/Managua')->format('Y-m-d'),
            'remision_origen' => $request->remision_origen??null,
            'hora_entrada' => now('America/Managua')->format('H:i:s'),
            'hora_salida' => $hora_salida,
            'client_id' => $request->client_id,
            'servicio_id' => $request->servicio_id,
            'vapor' => $request->vapor??null,
            'peso_segun_puerto' => $request->peso_segun_puerto??null,
            'creado_por' => auth()->user()->id,
            'ultima_modificacion_por' => auth()->user()->id,
            'silo_id' => $request->silo_id??null,
            'presentacion' => $request->presentacion,
            'producto' => $request->producto,
            'unidad_medida' => $request->unidad_medida,
            'temperatura' => $request->temperatura??null,
            'humedad' => $request->humedad??null,
            'impureza' => $request->impureza??null,
            'grano_quebrado' => $request->grano_quebrado??null,
            'grano_no_desarrollado' => $request->grano_no_desarrollado??null,
            'conductor' => $request->conductor,
            'placa' => $request->placa,
            'cedula_conductor' => $request->cedula_conductor,
            'peso_bruto' => $request->peso_bruto,
            'peso_tara' => $request->peso_tara??null,
            'peso_neto' => $request->peso_neto??null,
            'movimiento' => $request->movimiento,
            'observaciones' => $request->observaciones??null,
            'estado' => $request->estado,
            'remision_general_xlsx' => $request->remision_general_xlsx??null,
            'recibo_ingreso_xlsx' => $request->recibo_ingreso_xlsx??null,
            'recibo_egreso_xlsx' => $request->recibo_egreso_xlsx??null,
        ]);
        return $remission;
    }

    public function FinishRemission(){
        //
    }
}
