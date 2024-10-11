<?php

namespace App\Services;

use App\Models\Taller;

class TalleresService
{    public function getTalleres($id)
    {
        $talleres = Taller::where('estado',true)->where('programa_id',$id)->orderBy('id','asc')->get();
        return $talleres;
    }
}
