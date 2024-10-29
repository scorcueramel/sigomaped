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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function tipo_persona():BelongsTo{
        return $this->belongsTo( TipoPersona::class);
    }

    public function inscripcion(){
        return $this->hasMany(Inscripcion::class);
    }

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function representante(){
        return $this->hasMany(Representante::class);
    }

    public function padre_alumno(){
        return $this->hasMany(PadreAlumno::class);
    }

    public function encargado_ciclo(){
        return $this->hasMany(EncargadoCiclo::class);
    }

    public function espera_persona_taller(){
        return $this->hasMany(EsperaPersonaTaller::class);
    }
}
