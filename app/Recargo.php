<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recargo extends Model
{
    protected $fillable = [
        'porteros', 'ordinarioNoc', 'diurnoFest', 'nocturnoFes', 'extraDiurna', 'extraNocturna', 
        'extraDiurnaFest', 'extraNocturnaFest', 'Total', 
    ];

    public function portero(){
        return $this->belongsTo(User::class,'porteros');
    }
}
