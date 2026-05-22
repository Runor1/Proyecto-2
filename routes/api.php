<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {

    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $user = \App\Models\User::where('username', $request->username)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {

        return response()->json([
            'message' => 'Credenciales inválidas'
        ], 401);
    }

    $token = $user->createToken('token')->plainTextToken;

    return response()->json([
        'token' => $token,
    'rol_id' => $user->rol_id,
    'username' => $user->username
    ]);
});