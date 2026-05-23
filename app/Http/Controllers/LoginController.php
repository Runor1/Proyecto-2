<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function autenticar(Request $request)
    {
        $credenciales = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credenciales)) {

            $user = Auth::user();

            if ($user->rol_id == 2) {
                return redirect('/admin');
            }

            return redirect('/horarioClases');
        }

        return back()->withErrors([
            'login' => 'Credenciales incorrectas'
        ]);
    }
    public function login()
    {
        return view('login.login');
    }
    public function formulario()
    {
        return view('login.formularioVikingNuevo');
    }
    public function inicio()
    {
        return view('login.inicio');
    }
}
