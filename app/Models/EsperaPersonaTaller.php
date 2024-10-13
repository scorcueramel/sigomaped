<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EsperaPersonaTaller extends Model
{
    protected $fillable = [
        'persona_id',
        'taller_id',
        'inscrito',
        'usuario_actualiza',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function taller(){
        return $this->belongsTo(Taller::class);
    }
}
