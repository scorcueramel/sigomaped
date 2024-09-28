<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $fillable = [
        'programa_id',
        'tipo_taller_id',
        'nombre',
        'usuario_actualiza',
    ];

    public function tipoTaller(){
        $this->hasOne(TipoTaller::class,'tipo_taller_id');
    }

    public function programa(){
        $this->hasOne(Programa::class,'programa_id');
    }

    public function ciclo(){
        $this->hasMany(Ciclo::class,'taller_id');
    }
}
