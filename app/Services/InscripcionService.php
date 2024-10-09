<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class InscripcionService{
    public function getInscritos($id){
        $inscritos = DB::select("SELECT CONCAT(p.nombres,' ',p.apellidos) as \"nombres\", d.dia, h.hora_inicio, h.hora_fin
                                    FROM inscripcions i
                                    LEFT JOIN personas p ON p.id = i.persona_id
                                    LEFT JOIN horarios h ON h.id = i.horario_id
                                    LEFT JOIN dias d ON d.id = h.dia_id
                                    LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                    LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                    WHERE c.id = ?",[$id]);
        return $inscritos;
    }
}
