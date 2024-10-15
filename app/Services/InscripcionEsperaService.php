<?php

namespace App\Services;

use App\Data\ListaEsperaTallerData;
use App\Models\EsperaPersonaTaller;

class InscripcionEsperaService{

    public array $listaDeEspera = [];

    public function getListaEspera(){
        $alumnosEspera = EsperaPersonaTaller::where("inscrito","=","E")->with('taller')->get();

        foreach($alumnosEspera as $key => $value){
            $this->listaDeEspera[] = ListaEsperaTallerData::from(['alumnoid'=>$alumnosEspera[$key]->persona_id,'tallerid'=>$alumnosEspera[$key]->taller_id,'inscrito'=>$alumnosEspera[$key]->inscrito,'tallernombre'=>$alumnosEspera[$key]->taller->nombre]);
        }

        return $this->listaDeEspera;
    }

    public function inscribirEspera(array $alumnoinscribir)
    {
        foreach ($alumnoinscribir as $inscripcion) {

            $isEspera = EsperaPersonaTaller::where("persona_id",$inscripcion->alumnoid)->where("taller_id",$inscripcion->tallerid)->where("inscrito",'E')->get();

            if(count($isEspera) >= 1)
                return 300;

            $nuevoInscrito = new EsperaPersonaTaller();
            $nuevoInscrito->persona_id = $inscripcion->alumnoid;
            $nuevoInscrito->taller_id = $inscripcion->tallerid;
            $nuevoInscrito->inscrito = $inscripcion->inscrito;
            $nuevoInscrito->save();
        }

        return 200;
    }
}
