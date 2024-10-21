<?php

namespace App\Services;

use App\Data\CondicionSocioEconomicaData;
use App\Models\CondicionSocioEconomica;

class CondicionSocioEconomicaService {

    public array $condicionesAll = [];

    public function getCondicionSocioEconomica(){
        $condiciones = CondicionSocioEconomica::all();
        foreach($condiciones as $condicion){
            $this->condicionesAll[] = CondicionSocioEconomicaData::from([
                'cseid'=>$condicion->id,
                'csedescripcion'=>$condicion->condicion,
            ]);
        }
        return $this->condicionesAll;
    }

}
