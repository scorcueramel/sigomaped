<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscripcion_id',
        'fecha',
        'inasistio',
        'justificada',
        'motivo',
        'usuario_actualiza',
    ];

    public function inscripcion(){
        return $this->belongsTo(Inscripcion::class);
    }
}
