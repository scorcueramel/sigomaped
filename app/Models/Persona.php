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

    public function encargadoCiclo(){
        return $this->hasMany(EncargadoCiclo::class);
    }
    
    public function esperaPersonaTaller(){
        return $this->hasMany(EsperaPersonaTaller::class);
    }
}
