<?php

namespace App\Services;

use App\Models\Inscripcion;

class InscripcionService{
    public function getInscritos(){
        $inscritos = Inscripcion::all();
        return $inscritos;
    }
}