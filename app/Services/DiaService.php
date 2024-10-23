<?php

namespace App\Services;

use App\Data\DiaData;
use Illuminate\Support\Facades\DB;

class DiaService
{
    public array $dias = [];

    public function getDiasBytaller($id): array
    {
        $dias = DB::select("SELECT d.id as dia_id, d.dia as dia_nombre from dias d
                                    LEFT JOIN horarios h on h.dia_id = d.id
                                    LEFT JOIN inscripcions i on i.horario_id = h.id
                                    LEFT JOIN ciclo_horarios ch on ch.horario_id = h.id
                                    LEFT JOIN ciclos c on c.id = ch.ciclo_id
                                    where c.estado = true and i.estado_inscripcion = 'I' and c.taller_id = ?
                                    group by d.id, d.dia;", [$id]);
        foreach ($dias as $dia) {
            $this->dias[] = DiaData::from([
                'diaid' => $dia->dia_id,
                'dianombre' => $dia->dia_nombre,
            ]);
        }
        return $this->dias;
    }
}
