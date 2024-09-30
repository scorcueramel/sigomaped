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
        return $this->belongsTo(TipoTaller::class);
    }

    public function programa(){
        return $this->belongsTo(Programa::class);
    }

    public function ciclo(){
        return $this->hasMany(Ciclo::class);
    }
}
