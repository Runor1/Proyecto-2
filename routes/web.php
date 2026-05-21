<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('login.inicio');
});

Route::get('/login', [LoginController::class, 'login']);

Route::get('/formulario', [LoginController::class, 'formulario']);

Route::get('/admin', [AdminController::class, 'dashboard']);


