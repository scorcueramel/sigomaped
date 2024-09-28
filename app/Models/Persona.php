<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_persona_id',
        'documento',
        'nombres',
        'apellidos',
    ];

    public function tipo_persona():BelongsTo{
        return $this->belongsTo( TipoPersona::class);
    }

    public function inscripcion(){
        $this->hasMany(Inscripcion::class);
    }

    public function datosAlumno(){
        $this->hasMany(DatosAlumno::class);
    }

    public function user(){
        $this->hasMany(Persona::class);
    }
}
