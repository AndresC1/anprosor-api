<?php

namespace App\Http\Middleware\User;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_auth = auth()->user();
        $user_request = User::find((int)$request->user_id);
        if($user_request == null){
            return response()->json([
                'message' => 'el usuario no existe',
            ], 404);
        }
        if($user_auth->id == $user_request->id || ($user_auth->role_id == 1 && ($user_request->role_id == 2 || ($user_request->role_id == 1 && $user_request->is_active == 0) ))){
            return $next($request);
//            return response()->json([
//                'validacion1' => $user_auth->id == $user_request->id,
//                'validacion2' => $user_auth->role_id == 1 && $user_request->role_id == 2,
//                'validacion3' => $user_auth->role_id == 1 && $user_request->role_id == 1 && $user_request->is_active == 0,
//                'user_auth' => $user_auth->id,
//                'user_request' => $user_request->id,
//                'message' => 'puedes cambiar el estado de este usuario',
//            ], 200);
        }
        return response()->json([
            'message' => 'no puedes cambiar el estado de este usuario',
        ], 403);
    }
}
