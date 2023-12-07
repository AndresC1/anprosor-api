<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'temperatura',
        'humedad',
        'impurezas',
        'grano_quebrado',
        'grano_no_desarrollado',
        'hongo',
    ];
}
