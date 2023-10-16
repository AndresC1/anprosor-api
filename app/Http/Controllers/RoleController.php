<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\InfoRoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        try{
            return response()->json([
                'roles' => InfoRoleResource::collection(Role::all()),
                'message' => 'lista de roles',
                'status' => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
