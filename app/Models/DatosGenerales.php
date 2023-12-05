<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosGenerales extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_documento',
        'fecha_registro',
        'hora_entrada',
        'hora_salida',
        'nombre_conductor',
        'cedula_conductor',
        'placa_vehiculo',
    ];

    public function operaciones()
    {
        return $this->hasOne(Operacion::class, 'datos_generales_id');
    }
}
