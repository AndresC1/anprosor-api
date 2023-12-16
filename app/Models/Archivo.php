<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'PDF',
        'Excel',
    ];

    public function detalle_operacion()
    {
        return $this->hasMany(DetalleOperacion::class, 'archivos_id');
    }
}
