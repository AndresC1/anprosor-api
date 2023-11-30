<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeStatusRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\InfoCleanUserResource;
use App\Http\Resources\User\InfoUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return response()->json([
            'user' => InfoUserResource::make(auth()->user()),
            'message' => 'User profile data',
            'status' => 200,
        ]);
    }

    public function index(){
        $users = User::where('id', '!=', auth()->user()->id)->paginate(10);

        return response()->json([
            'users' => InfoCleanUserResource::collection($users),
            'meta' => [
                'total' => $users->total(),
                'count' => $users->count(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'total_pages' => $users->lastPage(),
            ],
            'links' => [
                'first' => $users->url(1),
                'last' => $users->url($users->lastPage()),
                'prev' => $users->previousPageUrl(),
                'next' => $users->nextPageUrl(),
            ],
            'message' => 'List of users',
            'status' => 200,
        ]);
    }

    public function changeStatus(ChangeStatusRequest $request){
        $request->validated();
        $user = User::find($request->user_id);
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'user' => InfoCleanUserResource::make($user),
            'message' => 'User status changed',
            'status' => 200,
        ]);
    }

    public function update(UpdateUserRequest $request){
        try{
            $request->validated();
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $user->password,
                'change_password' => $user->change_password,
                'is_active' => $user->is_active,
                'last_password_change_at' => $user->last_password_change_at,
                'last_login_at' => $user->last_login_at,
                'role_id' => $user->role_id,
            ]);

            return response()->json([
                'user' => InfoCleanUserResource::make($user),
                'message' => 'User updated',
                'status' => 200,
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => 'error updating user',
                'error' => $e->getMessage(),
                'status' => 500,
            ]);
        }
    }

    public function changePassword(ChangePasswordRequest $request){
        try{
            $request->validated();
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->new_password),
                'change_password' => 1,
                'last_password_change_at' => now('America/Managua'),
            ]);
            Auth::user()->tokens()->delete();
            return response()->json([
                'message' => 'Changed password successfully',
                'status' => 200,
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => 'error changing password',
                'error' => $e->getMessage(),
                'status' => 500,
            ]);
        }
    }
}
