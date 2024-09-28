<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoMedico extends Model
{
    use HasFactory;

    protected $fillable = ['datos_alumnos_id','diagnostico'];

    public function datosAlumno(){
        $this->belongsTo(DatosAlumno::class);
    }
}
