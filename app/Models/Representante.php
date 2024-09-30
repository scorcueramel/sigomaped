<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'datos_alumno_id',
        'telefono',
        'email',
        'usuario_actualiza',
    ];

    public function datosAlumno(){
        return $this->belongsTo(DatosAlumno::class);
    }
}
