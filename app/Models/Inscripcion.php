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

    public function ciclo(){
        $this->belongsTo(Ciclo::class,'ciclo_id','id');
    }
    public function persona(){
        $this->belongsTo(Persona::class,'persona_id','id');
    }
}
