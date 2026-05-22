<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'diaSemana',
        'horario',
        'capacidad'
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
