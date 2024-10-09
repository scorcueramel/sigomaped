<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoMedico extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id','diagnostico'];

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }
}
