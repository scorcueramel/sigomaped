<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_genero'
    ];

    public function Alumno(){
        return $this->hasMany(Alumno::class);
    }
}