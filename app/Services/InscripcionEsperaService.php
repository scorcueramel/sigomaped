<?php

namespace App\Services;

use App\Models\EsperaPersonaTaller;

class InscripcionEsperaService{

    public function inscribirEspera(array $alumnoinscribir)
    {
        foreach ($alumnoinscribir as $inscripcion) {

            $isEspera = EsperaPersonaTaller::where("persona_id",$inscripcion->alumnoid)->where("taller_id",$inscripcion->tallerid)->where("inscrito",'E')->get();

            if(count($isEspera) >= 1){
                return 300;
            }

            $nuevoInscrito = new EsperaPersonaTaller();
            $nuevoInscrito->persona_id = $inscripcion->alumnoid;
            $nuevoInscrito->taller_id = $inscripcion->tallerid;
            $nuevoInscrito->inscrito = $inscripcion->inscrito;
            $nuevoInscrito->save();
        }

        return 200;
    }
}
