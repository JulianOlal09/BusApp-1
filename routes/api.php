<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    RutaController,
    HorarioController,
    AutobusController,
    SucursalController,
    TicketController,
    UserController
};

// Ruta de login
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Rutas de autobuses
    Route::apiResource('autobuses', AutobusController::class);

    // Rutas de rutas
    Route::get('rutas', [RutaController::class, 'index']);

    // Rutas de horarios
    Route::get('horarios', [HorarioController::class, 'index']);

    // Rutas de sucursales
    Route::apiResource('sucursales', SucursalController::class);

    // Rutas de tickets
    Route::apiResource('tickets', TicketController::class);

    // Rutas de usuarios
    Route::apiResource('usuarios', UserController::class);
});

// Ruta para obtener el usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
