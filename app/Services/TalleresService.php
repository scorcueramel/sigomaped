<?php

namespace App\Services;

use App\Models\Ciclo;
use App\Models\Taller;
use Illuminate\Support\Facades\DB;

class TalleresService
{
    public function getProgramas($id)
    {
        $programas = DB::select('SELECT p.id, p.nombre FROM tallers t 
                                        LEFT JOIN programas p ON p.id = t.programa_id 
                                        LEFT JOIN tipo_tallers tt ON tt.id = t.tipo_taller_id
                                        WHERE tt.id = ?
                                        GROUP BY p.nombre, p.id', [$id]);
        return $programas;
    }

    public function getTalleres($id)
    {
        $talleres = Taller::where('programa_id',$id)->get();
        return $talleres;
    }

    public function getCiclos($id){
        $ciclos = Ciclo::where('taller_id',$id)->get();
        return $ciclos;
    }
}