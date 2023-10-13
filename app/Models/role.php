<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rolePermission()
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
