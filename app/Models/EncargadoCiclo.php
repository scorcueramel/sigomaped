<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoCiclo extends Model
{
    protected $fillable = [
        'persona_id',
        'ciclo_horario_id',
    ];

    public function ciclo_horario(){
        return $this->belongsTo(CicloHorario::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
