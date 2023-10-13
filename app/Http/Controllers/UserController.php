<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangeStatusRequest;
use App\Http\Resources\User\InfoCleanUserResource;
use App\Http\Resources\User\InfoUserResource;
use App\Models\User;
use Illuminate\Http\Request;

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
        $user = User::find(request()->user_id);
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'user' => InfoCleanUserResource::make($user),
            'message' => 'User status changed',
            'status' => 200,
        ]);
    }
}
