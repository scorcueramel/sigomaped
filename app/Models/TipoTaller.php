<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTaller extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'usuario_actualiza',
    ];

    public function taller(){
        $this->belongsTo(Taller::class);
    }
}
