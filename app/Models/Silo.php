<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Silo extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'unit_of_measure',
        'capacity_total',
        'current_capacity',
        'used_capacity',
    ];
}
