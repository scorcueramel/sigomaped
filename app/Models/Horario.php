<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_id',
        'hora_inicio',
        'hora_fin',
        'usuario_actualiza',
    ];
        
    public function cicloHorario(){
        return $this->hasMany(CicloHorario::class);
    }

    public function dias(){
        return $this->belongsTo(Dia::class);
    }
}
