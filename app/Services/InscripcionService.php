<?php

namespace App\Services;

use App\Models\Inscripcion;

class InscripcionService{
    public function getInscritos(){
        $inscritos = Inscripcion::with('persona')->with('horario')->get();
        return $inscritos;
    }
}