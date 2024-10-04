<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDiscapacidad extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_discapacidad'];

    public function Alumno(){
        return $this->hasMany(Alumno::class);
    }
}
