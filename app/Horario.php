<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'porteros', 'sede', 'mes', 'primero', 'segundo', 'tercero', 'cuarto', 'quinto', 'sexto',
        'septimo', 'octavo', 'noveno', 'decimo', 'once', 'doce', 'trece', 'catorce', 'quince', 
        'dieciseis', 'diecisiete', 'diesocho', 'diecinueve', 'veinte', 'veintiuno', 'veintidos', 
        'veintitres', 'veinticuatro', 'veinticinco', 'veintiseis', 'veintisiete', 'veintiocho',
        'veintinueve', 'treinta', 'treintayuno',
    ];

    public function portero(){
        return $this->belongsTo(User::class,'porteros');
    }
        
}
