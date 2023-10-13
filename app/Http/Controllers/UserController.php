<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\InfoUserResource;
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
}
