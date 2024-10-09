<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicionSocioEconomica extends Model
{
    use HasFactory;

    protected $fillable = ['condicion'];

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
}
