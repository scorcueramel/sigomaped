<?php

namespace App\Services;

use App\Data\TiposPersonasData;
use App\Models\TipoPersona;

class TipoPersonaService {

    public array $tipospoersonas = [];

    public function getTiposServicios():array{
        $tipopersona = TipoPersona::all();

        foreach ($tipopersona as $tp) {
            $this->tipospoersonas[] = TiposPersonasData::from([
                "tipopersonaid"=> $tp->id,
                "tipopersonadescripcion"=> $tp->tipo_persona,
            ]);
        }

        return $this->tipospoersonas;
    }

}
