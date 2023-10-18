<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GrainsController;

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
            Route::get('/list', [UserController::class, 'index'])->middleware('check_permission:view_list_user');
            Route::post('/change_status', [UserController::class, 'changeStatus'])->middleware('change_status_user');
            Route::patch('/update', [UserController::class, 'update']);
            Route::post('/change_password', [UserController::class, 'changePassword']);
        });
        // Role
        Route::prefix('role')->group(function (){
            Route::get('/list', [RoleController::class, 'index'])->middleware('check_permission:add_user');
        });
        // Grain
        Route::apiResource('grain', GrainsController::class)->only(['store', 'index'])->middleware('check_permission:add_grain');
//        Route::get('/grain', [GrainsController::class, 'index']);
        Route::prefix('grain')->group(function (){
            Route::patch('/{grain}', [GrainsController::class, 'update'])->middleware('check_permission:edit_grain');
            Route::delete('/{grain}', [GrainsController::class, 'destroy'])->middleware('check_permission:delete_grain');
        });
    });
});
