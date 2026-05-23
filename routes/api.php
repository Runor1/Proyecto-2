<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioController;

Route::get('/login', function () {
    return response()->json(['message' => 'No autorizado'], 401);
})->name('login');

Route::post('/login', function (Request $request) {

    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $user = User::where('username', $request->username)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {

        return response()->json([
            'message' => 'Credenciales inválidas'
        ], 401);
    }

    $token = $user->createToken('token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'rol_id'   => $user->rol_id,
        'user' => $user
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    // Clases
    Route::get('/clases', [ClaseController::class, 'index']);
    Route::post('/clases', [ClaseController::class, 'store']);
    Route::get('/clases/{id}', [ClaseController::class, 'show']);
    Route::put('/clases/{id}', [ClaseController::class, 'update']);
    Route::delete('/clases/{id}', [ClaseController::class, 'destroy']);

    // Reservas
    Route::get('/reservas', [ReservaController::class, 'index']);
    Route::post('/reservas', [ReservaController::class, 'store']);
    Route::get('/reservas/{id}', [ReservaController::class, 'show']);
    Route::put('/reservas/{id}', [ReservaController::class, 'update']);
    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy']);
    Route::patch('/reservas/{id}/cancelar', [ReservaController::class, 'cancelar']);

    // Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {

    return response()->json($request->user());
});
