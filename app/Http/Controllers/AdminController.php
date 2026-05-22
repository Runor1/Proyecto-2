<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.adminDashboard');
    }

    public function crearClase()
    {

        return view('admin.crearClase');
    }

    public function clasesVista()
    {
        return view('admin.clasesVista');
    }

    public function usuariosVista()
    {
        return view('admin.usuariosVista');
    }
}
