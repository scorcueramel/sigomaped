<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'usuario_actualiza',
    ];

    public function taller(){
        return $this->hasMany(Taller::class);
    }
}
