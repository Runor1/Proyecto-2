<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('login.inicio');
});

Route::get('/login', [LoginController::class, 'login']);

Route::get('/formulario', [LoginController::class, 'formulario']);

Route::get('/admin', [AdminController::class, 'dashboard']);

Route::get('/crearClase', [AdminController::class, 'crearClase']);

Route::get('/clasesVista', [AdminController::class, 'clasesVista']);

Route::get('/gestionReservas', [ReservaController::class, 'gestionReservas']);

Route::get('/historial', [UsuarioController::class, 'getHistorial']);

Route::get('/horarioClases', [UsuarioController::class, 'getHorarioClases']);

Route::get('/reservas', [ReservaController::class, 'reservas']);

route::get('/usuariosVista', [AdminController::class, 'usuariosVista']);



