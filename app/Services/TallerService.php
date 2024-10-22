<?php

namespace App\Services;

use App\Models\Taller;
use Illuminate\Support\Facades\DB;

class TallerService
{    
    public function getTalleresAll()
    {
        $talleres = DB::select("SELECT p.nombre as programa, tt.descripcion as tipo, t.nombre, t.estado, t.created_at as fecha
                            from tallers t
                            inner join programas p on p.id = t.programa_id
                            inner join tipo_tallers tt on tt.id = t.tipo_taller_id
                            order by t.nombre asc");
        return $talleres;
    }

    public function getTalleres($id)
    {
        $talleres = Taller::where('estado',true)->where('programa_id',$id)->orderBy('id','asc')->get();
        return $talleres;
    }
}
