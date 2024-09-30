<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicionSocioEconomica extends Model
{
    use HasFactory;

    protected $fillable = ['condicion'];

    public function datosAlumno(){
        return $this->hasMany(DatosAlumno::class);
    }
}
