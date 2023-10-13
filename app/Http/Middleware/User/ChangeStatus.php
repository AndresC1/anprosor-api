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
        $user_request = User::find($request->user_id);
        if($user_auth->id == $user_request->id || ($user_auth->role_id == 1 && $user_request->is_active == 0) || ($user_auth->role_id == 1 && $user_request->role_id != 1)){
            return $next($request);
        }
        return response()->json([
            'message' => 'no puedes cambiar el estado de este usuario',
        ], 403);
    }
}
