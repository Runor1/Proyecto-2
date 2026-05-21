<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
   // Route::apiResource('barcos', BarcoController::class);
});
Route::post('/login', function (Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Sesión cerrada'
    ]);
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/perfil', function (Request $request) {
    return $request->user();
});
