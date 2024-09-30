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
        return $this->belongsTo(Taller::class);
    }

    public function inscripcion(){
        return $this->hasMany(Inscripcion::class);
    }

    public function horario(){
        return $this->hasMany(Horario::class);
    }
}
