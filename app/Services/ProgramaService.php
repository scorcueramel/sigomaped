<?php

namespace App\Services;

use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class ProgramaService{
    public function getProgramasAll(){
        $programas = Programa::all();
        return $programas;
    }

    public function getValidateInscriptionUser($tipo_programa, $alumno_id){
        $validation = DB::select('SELECT
                                            p.id AS "persona_id",
                                            t.id AS "taller_id",
                                            t.tipo_taller_id AS "tipo_taller"
                                        FROM tallers t
                                        LEFT JOIN ciclos c
                                            ON c.taller_id = t.id
                                        LEFT JOIN ciclo_horarios ch
                                            ON ch.ciclo_id = c.id
                                        LEFT JOIN horarios h
                                            ON h.id = ch.horario_id
                                        LEFT JOIN inscripcions i
                                            ON i.horario_id = h.id
                                        LEFT JOIN personas p
                                            ON p.id = i.persona_id
                                        WHERE p.id = ? AND t.tipo_taller_id = ?;',[$alumno_id,$tipo_programa]);

        return $validation;
    }

    public function getProgramas($id)
    {
        $programas = DB::select('SELECT p.id, p.nombre FROM tallers t
                                        LEFT JOIN programas p ON p.id = t.programa_id
                                        LEFT JOIN tipo_tallers tt ON tt.id = t.tipo_taller_id
                                        WHERE tt.id = ?
                                        GROUP BY p.nombre, p.id', [$id]);
        return $programas;
    }
}
