<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function (){
    Route::prefix('auth')->group(function (){
        Route::post('/login', [AuthController::class, 'login']);
    });
    Route::middleware('auth:sanctum')->group(function (){
        // Authenticated
        Route::prefix('auth')->group(function (){
            Route::post('/register', [AuthController::class, 'register'])->middleware('check_permission:add_user');
            Route::post('/logout', [AuthController::class, 'logout']);
        });
        // User
        Route::prefix('user')->group(function (){
            Route::get('/info', [UserController::class, 'show']);
        });
    });
});
