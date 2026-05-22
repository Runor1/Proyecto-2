<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $existe = User::where('userName', $request->userName)->exists();
        if ($existe) {
            return response()->json(['error' => 'El nombre de usuario ya existe'], 400);
        }

        $user = User::create([
            'nombre'      => $request->nombre,
            'apellidos'   => $request->apellidos,
            'email'       => $request->email,
            'telefono'    => $request->telefono,
            'userName'    => $request->userName,
            'password'    => Hash::make($request->password),
            'rol_id'      => $request->rol_id ?? 1,
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->except('password') +
            ($request->password ? ['password' => Hash::make($request->password)] : []));

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}
