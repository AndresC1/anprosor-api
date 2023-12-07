<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grains extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function detalleOperacion()
    {
        return $this->hasMany(DetalleOperacion::class, 'producto_id');
    }
}
