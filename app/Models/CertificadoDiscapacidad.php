<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoDiscapacidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'emision_cert_discapacidad',
        'vigencia_cert_discapacidad',
    ];

    public function Alumno(){
        return $this->belongsTo(Alumno::class);
    }
}
