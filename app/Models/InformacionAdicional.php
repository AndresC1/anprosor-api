<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionAdicional extends Model
{
    use HasFactory;

    protected $fillable = [
        'creado_por',
        'actualizado_por',
        'observaciones',
    ];

    public function CreadoPor(){
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function ActualizadoPor(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
