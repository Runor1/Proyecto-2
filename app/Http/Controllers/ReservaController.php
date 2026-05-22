<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['user', 'clase'])->get();
        return response()->json($reservas);
    }

    public function store(Request $request)
    {
        $clase = Clase::find($request->clase_id);
        if (!$clase) {
            return response()->json(['error' => 'Clase no encontrada'], 404);
        }

        if ($clase->capacidad <= 0) {
            return response()->json(['error' => 'No hay cupos disponibles'], 400);
        }

        $existe = Reserva::where('user_id', $request->user_id)
            ->where('clase_id', $request->clase_id)
            ->exists();

        if ($existe) {
            return response()->json(['error' => 'Ya tienes una reserva para esta clase'], 400);
        }

        $clase->capacidad -= 1;
        $clase->save();

        $reserva = Reserva::create([
            'user_id'      => $request->user_id,
            'clase_id'     => $request->clase_id,
            'fechaReserva' => $request->fechaReserva ?? now()->toDateString(),
            'estado'       => 'ACTIVA',
        ]);

        return response()->json($reserva->load(['user', 'clase']), 201);
    }

    public function show($id)
    {
        $reserva = Reserva::with(['user', 'clase'])->find($id);
        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reserva);
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::find($id);
        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }
        $reserva->update($request->all());
        return response()->json($reserva);
    }

    public function destroy($id)
    {
        $reserva = Reserva::with('clase')->find($id);
        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        $reserva->clase->capacidad += 1;
        $reserva->clase->save();
        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada']);
    }

    public function cancelar($id)
    {
        $reserva = Reserva::with('clase')->find($id);
        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        if ($reserva->estado === 'CANCELADA') {
            return response()->json(['error' => 'La reserva ya está cancelada'], 400);
        }

        $reserva->estado = 'CANCELADA';
        $reserva->clase->capacidad += 1;
        $reserva->clase->save();
        $reserva->save();

        return response()->json($reserva);
    }

    public function gestionReservas()
    {

        return view('reservations.gestionReservas');
    }

    public function reservas()
    {

        return view('reservations.reservas');
    }
}
