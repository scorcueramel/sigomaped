<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'ciclo_id',
        'es_derivado',
        'fecha_derivacion',
        'fecha_derivada',
        'estado_inscripcion',
        'es_espera',
        'fecha_inscripcion',
        'usuario_actualiza',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function ciclo(){
        return $this->belongsTo(Ciclo::class);
    }

    public function asistencia(){
        return $this->hasMany(Asistencia::class);
    }
}
