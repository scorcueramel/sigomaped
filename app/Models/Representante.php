<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'alumno_id',
        'telefono',
        'email',
        'usuario_actualiza',
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }
    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
