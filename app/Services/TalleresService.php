<?php

namespace App\Services;

use App\Models\Taller;

class TalleresService
{    public function getTalleres($id)
    {
        $talleres = Taller::where('programa_id',$id)->get();
        return $talleres;
    }
}