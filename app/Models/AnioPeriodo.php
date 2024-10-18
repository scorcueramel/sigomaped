<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnioPeriodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'estado',
    ];

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
}
