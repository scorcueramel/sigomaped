<?php

namespace App\Services;

use App\Models\Persona;

class PersonaService{
    public function getPersonas($documento){
        $persona = Persona::where('documento',$documento)
                    ->where('tipo_persona_id',6)
                    ->with('tipo_persona')
                    ->get();
        return $persona;
    }
}