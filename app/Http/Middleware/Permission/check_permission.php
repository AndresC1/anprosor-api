<?php

namespace App\Http\Middleware\Permission;

use App\Models\permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class check_permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$params): Response
    {
        try{
            $id_permission = permission::where('name', $params[0])->first()->id;
            if(!Auth::user()->role->rolePermission->map->permission_id->contains($id_permission)){
                return response()->json([
                    'mensaje' => 'No tienes permiso para realizar esta acción',
                    'estado' => 403
                ], 403);
            }
            return $next($request);
        } catch (\Throwable $th) {
            return response()->json([
                'mensaje' => 'Error al verificar permisos',
                'error' => $th->getMessage(),
                'estado' => 500
            ], 500);
        }
    }
}
