<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_id');
    }
}
