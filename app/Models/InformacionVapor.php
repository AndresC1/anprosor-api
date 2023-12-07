<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionVapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'vapor', // Nombre del barco
        'remision_origen',
        'peso_segun_puerto',
        'unidad_medida',
    ];

    public function detalleOperacion()
    {
        return $this->hasMany(DetalleOperacion::class, 'informacion_vapor_id');
    }
}
