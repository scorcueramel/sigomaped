<?php

namespace App\Services;

use App\Data\TiposPersonasData;
use App\Models\TipoPersona;

class TipoPersonaService {

    public array $tipospoersonas = [];

    public function getTiposPersonasServicios():array{
        $tipopersona = TipoPersona::all();

        foreach ($tipopersona as $tp) {
            $this->tipospoersonas[] = TiposPersonasData::from([
                "tipopersonaid"=> $tp->id,
                "tipopersonadescripcion"=> $tp->tipo_persona,
            ]);
        }

        return $this->tipospoersonas;
    }

    public function getTiposPersonasFilter():array{
        $tipopersona = TipoPersona::all();

        foreach ($tipopersona as $tp) {
            if ($tp->tipo_persona == "ADMINISTRADOR" || $tp->tipo_persona == "ENCARGADO" || $tp->tipo_persona == "ALUMNO") {
                $this->tipospoersonas[] = TiposPersonasData::from([
                    "tipopersonaid"=> $tp->id,
                    "tipopersonadescripcion"=> $tp->tipo_persona,
                ]);
            }
        }

        return $this->tipospoersonas;
    }

}
