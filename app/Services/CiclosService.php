<?php

namespace App\Services;

use App\Models\Ciclo;

class CiclosService{
    public function getCiclos($id){
        $ciclos = Ciclo::where('taller_id',$id)->get();
        return $ciclos;
    }

    public function getCiclosBytaller($id){
        $ciclos = Ciclo::where('taller_id',$id)->get();
        return $ciclos;
    }
}
