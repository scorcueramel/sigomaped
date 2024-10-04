<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestacionVoluntad extends Model
{
    use HasFactory;

    protected $fillable = ['manifestacion'];

    public function Alumno(){
        return $this->hasMany(Alumno::class);
    }
}
