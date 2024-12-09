<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\AutobusController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas para el CRUD de Usuarios
Route::middleware('auth')->group(function () {
    Route::resource('usuarios', UserController::class);
});

// Rutas para el CRUD de Sucursales
Route::middleware('auth')->group(function () {
    Route::resource('sucursales', SucursalController::class)->parameters([
        'sucursales' => 'sucursal',
    ]);
});

// Rutas para el CRUD de Rutas
Route::middleware(['auth'])->group(function () {
    Route::resource('rutas', RutaController::class);
});

// Rutas para el CRUD de Autobuses
Route::middleware('auth')->group(function () {
    Route::resource('autobuses', AutobusController::class);
});

// Rutas para el CRUD de Horarios
Route::middleware('auth')->group(function () {
    Route::resource('horarios', HorarioController::class);
});

// Rutas para el CRUD de Tickets
Route::resource('tickets', TicketController::class);