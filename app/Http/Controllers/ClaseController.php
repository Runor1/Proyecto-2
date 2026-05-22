<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        return response()->json(Clase::all());
    }

    public function store(Request $request)
    {
        $existe = Clase::where('diaSemana', $request->diaSemana)
            ->where('horario', $request->horario)
            ->exists();

        if ($existe) {
            return response()->json(['error' => 'Ya existe una clase con ese día y hora'], 400);
        }

        $clase = Clase::create($request->all());
        return response()->json($clase, 201);
    }

    public function show($id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['error' => 'Clase no encontrada'], 404);
        }
        return response()->json($clase);
    }

    public function update(Request $request, $id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['error' => 'Clase no encontrada'], 404);
        }
        $clase->update($request->all());
        return response()->json($clase);
    }

    public function destroy($id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['error' => 'Clase no encontrada'], 404);
        }
        $clase->delete();
        return response()->json(['message' => 'Clase eliminada']);
    }
}
