<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloHorario extends Model
{
    protected $fillable = [
        'ciclo_id',
        'horario_id',
        'cupo_maximo',
        'cupo_actual',
        'usuario_actualiza',
    ];
    
    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function ciclos(){
        return $this->belongsTo(Ciclo::class);
    }
    
    public function encargadoCiclo(){
        return $this->hasMany(EncargadoCiclo::class);
    }
}
