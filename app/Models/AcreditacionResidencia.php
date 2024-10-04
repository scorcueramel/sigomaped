<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcreditacionResidencia extends Model
{
    use HasFactory;

    protected $fillable = ['acreditacion'];

    public function datosAlumno(){
        return $this->hasMany(Alumno::class);
    }
}
