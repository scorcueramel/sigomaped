<?php

namespace App\Services;

use App\Data\DiaData;
use App\Models\Ciclo;
use Illuminate\Support\Facades\DB;

class CiclosService
{

    public function getCiclosBytaller($id)
    {
        $ciclos = Ciclo::where('estado', true)->where('taller_id', $id)->with('periodo')->get();
        return $ciclos;
    }

}
