<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOperacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'origen',
        'informacion_vapor_id',
        'silo_id',
        'producto_id',
        'presentacion',
        'analisis_id',
        'pesaje_id',
        'observacion',
        'operacion_id',
    ];

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function informacionVapor()
    {
        return $this->belongsTo(InformacionVapor::class, 'informacion_vapor_id');
    }

    public function silo()
    {
        return $this->belongsTo(Silo::class, 'silo_id');
    }

    public function producto()
    {
        return $this->belongsTo(Grains::class, 'producto_id');
    }

    public function analisis()
    {
        return $this->belongsTo(Analisi::class, 'analisis_id');
    }

    public function pesaje()
    {
        return $this->belongsTo(Pesaje::class, 'pesaje_id');
    }

    public function operacion()
    {
        return $this->belongsTo(Operacion::class, 'operacion_id');
    }
}
