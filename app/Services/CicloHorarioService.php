<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CicloHorarioService{
    public function getHorarioCiclos($id){
        // $cicloHorario = CicloHorario::where('ciclo_id',$id)->get();
        $cicloHorario = DB::select('SELECT
                                                h.id, d.dia , h.hora_inicio , h.hora_fin , ch.cupo_maximo , ch.cupo_actual
                                            FROM ciclo_horarios ch
                                            LEFT JOIN horarios h ON h.id = ch.horario_id
                                            LEFT JOIN dias d ON d.id = h.dia_id
                                            WHERE ch.ciclo_id = ?', [$id]);
        return $cicloHorario;
    }

}
