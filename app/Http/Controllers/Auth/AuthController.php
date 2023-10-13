<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\LoginResource;
use App\Http\Resources\User\RegisterResource;
use App\Models\Generate\Generate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'credenciales invalidas',
                'estado' => 401
            ], 401);
        }

        auth()->user()->tokens()->delete();

        $user = User::where('email', $request->email)->firstOrFail();
        $user->last_login_at = now('America/Managua')->format('Y-m-d H:i:s');
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => LoginResource::make($user),
            'token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Login exitoso',
            'status' => 200
        ], 200);
    }

    public function register(RegisterRequest $request){
        $request->validated();

        $password = Generate::Password();
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'change_password' => false,
            'is_active' => true,
        ]);

        $user->save();

        return response()->json([
            'user' => RegisterResource::make($user),
            'password_generated' => $password,
            'message' => 'Usuario creado exitosamente!',
        ], 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesion cerrada exitosamente!',
            'status' => 200
        ], 200);
    }
}
