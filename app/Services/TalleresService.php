<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TalleresService
{
    public function getTalleres($id)
    {
        $programas = DB::select('select * from tallers t where t.tipo_taller_id = ?', [$id]);
        return $programas;
    }
    public function getCicloTalleres($id)
    {
        $ciclo = DB::select('select * from tallers t where t.tipo_taller_id = ?', [$id]);
        return $ciclo;
    }
}