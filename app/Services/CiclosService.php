<?php

namespace App\Services;

use App\Models\Ciclo;

class CiclosService{
    public function getCiclosBytaller($id){
        $ciclos = Ciclo::where('estado',true)->where('taller_id',$id)->with('periodo')->get();
        return $ciclos;
    }
}
