<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = [
        'taller_id',
        'anio',
        'periodo',
        'fecha_inicio',
        'fecha_fin',
        'usuario_actualiza',
    ];
        
    public function cicloHorario(){
        return $this->hasMany(CicloHorario::class);
    }

    public function taller(){
        return $this->belongsTo(Taller::class);
    }
}
