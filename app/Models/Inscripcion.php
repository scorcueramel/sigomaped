<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'horario_id',
        'es_derivado',
        'fecha_derivacion',
        'estado_inscripcion',
        'fecha_inscripcion',
        'usuario_actualiza',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function asistencia(){
        return $this->hasMany(Asistencia::class);
    }
}
