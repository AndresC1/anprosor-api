<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GrainsController;
use App\Http\Controllers\SiloController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Conversion\ConverterController;
use App\Http\Controllers\RemissionController;
use App\Http\Controllers\ClientController;

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
        Route::apiResource('grain', GrainsController::class)->only(['store'])->middleware('check_permission:add_grain');
        Route::apiResource('grain', GrainsController::class)->only(['index'])->middleware('check_permission:show_grain');
        Route::prefix('grain')->group(function (){
            Route::put('/{grain}', [GrainsController::class, 'update'])->middleware('check_permission:edit_grain');
            Route::delete('/{grain}', [GrainsController::class, 'destroy'])->middleware('check_permission:delete_grain');
        });
        // Silo
        Route::apiResource('silo', SiloController::class)->only(['store'])->middleware('check_permission:add_silo');
        Route::apiResource('silo', SiloController::class)->only(['index'])->middleware('check_permission:show_silo');
        Route::prefix('silo')->group(function (){
            Route::patch('/{silos}', [SiloController::class, 'update'])->middleware('check_permission:edit_silo');
            Route::delete('/{silo}', [SiloController::class, 'destroy'])->middleware('check_permission:delete_silo');
        });
        // Service
        Route::apiResource('service', ServiceController::class)->only(['store'])->middleware('check_permission:add_service');
        Route::apiResource('service', ServiceController::class)->only(['index'])->middleware('check_permission:show_service');
        Route::prefix('service')->group(function (){
            Route::patch('/{services}', [ServiceController::class, 'update'])->middleware('check_permission:edit_service');
            Route::delete('/{services}', [ServiceController::class, 'destroy'])->middleware('check_permission:delete_service');
        });
        // Conversion
        Route::get('/converter', [ConverterController::class, "converter"]);
        // Remission
        Route::apiResource('remission', RemissionController::class)->only(['store', 'index'])->middleware('check_permission:add_remission');
        Route::prefix('remission')->group(function (){
            Route::get('/{remission}', [RemissionController::class, 'show']);
            Route::post('/finish/{id}', [RemissionController::class, 'finishRemission'])->middleware('check_permission:add_remission');
        });
        // Client
        Route::apiResource('client', ClientController::class)->only(['store'])->middleware('check_permission:add_client');
        Route::apiResource('client', ClientController::class)->only(['index'])->middleware('check_permission:show_client');
        Route::prefix('client')->group(function (){
            Route::patch('/{clients}', [ClientController::class, 'update'])->middleware('check_permission:edit_client');
            Route::delete('/{clients}', [ClientController::class, 'destroy'])->middleware('check_permission:delete_client');
        });
    });
});
