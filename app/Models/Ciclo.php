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
        'periodo_id',
        'fecha_inicio',
        'fecha_fin',
        'usuario_actualiza',
    ];

    public function ciclo_horario(){
        return $this->hasMany(CicloHorario::class);
    }

    public function taller(){
        return $this->belongsTo(Taller::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }
}
