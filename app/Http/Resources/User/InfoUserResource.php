<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Role\InfoRoleResource;

class InfoUserResource extends JsonResource
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
            'email' => $this->email,
            'change_password' => $this->change_password,
            'is_active' => $this->is_active,
            'last_password_change_at' => $this->last_password_change_at,
            'last_login_at' => $this->last_login_at,
            'role' => InfoRoleResource::make($this->role),
        ];
    }
}
