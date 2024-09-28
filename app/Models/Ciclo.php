<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = [
        'taller_id',
        'anio',
        'periodo',
        'fecha_inicio',
        'fecha_fin',
        'cupos_maximos',
        'cupos_actuales',
        'usuario_actualiza',
    ];

    public function taller(){
        $this->belongsTo(Taller::class);
    }

    public function inscripcion(){
        $this->hasMany(Inscripcion::class);
    }

    public function horario(){
        $this->hasMany(Horario::class);
    }
}
