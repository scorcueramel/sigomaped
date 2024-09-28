<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoDiscapacidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'datos_alumno_id',
        'emision_cert_discapacidad',
        'vigencia_cert_discapacidad',
    ];

    public function datosAlumno(){
        $this->belongsTo(DatosAlumno::class);
    }
}
