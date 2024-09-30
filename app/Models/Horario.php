<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'ciclo_id',
        'dia',
        'hora_inicio',
        'hora_fin',
        'usuario_actualiza',
    ];

    public function ciclos(){
        return $this->belongsTo(Ciclo::class);
    }
}
