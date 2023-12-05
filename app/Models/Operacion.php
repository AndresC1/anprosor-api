<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'movimiento',
        'datos_generales_id',
        'informacion_adicional_id',
        'estado',
    ];

    public function datos_generales()
    {
        return $this->belongsTo(DatosGenerales::class, 'datos_generales_id');
    }

    public function informacion_adicional()
    {
        return $this->belongsTo(InformacionAdicional::class, 'informacion_adicional_id');
    }
}
