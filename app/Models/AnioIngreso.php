<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnioIngreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'periodo_id',
        'anio',
    ];

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function datosAlumno(){
        return $this->hasMany(DatosAlumno::class);
    }
}
