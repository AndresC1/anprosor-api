<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Permission\InfoPermissionResource;
use App\Models\permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->rolePermission->map(function (RolePermission $role_permission) {
                return InfoPermissionResource::make(permission::find($role_permission->permission_id));
            }),
        ];
    }
}
