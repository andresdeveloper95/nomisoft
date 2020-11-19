<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'codigo', 'horaInicio', 'horaFin',
    ];
}
