<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSeguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_seguro'
    ];

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
}
