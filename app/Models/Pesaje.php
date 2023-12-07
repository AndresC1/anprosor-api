<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'peso_bruto',
        'peso_tara',
        'peso_neto',
        'unidad_medida',
    ];

    public function detalleOperacion()
    {
        return $this->hasOne(DetalleOperacion::class, 'pesaje_id');
    }
}
