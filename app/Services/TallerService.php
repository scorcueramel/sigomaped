<?php

namespace App\Services;

use App\Models\Taller;
use Illuminate\Support\Facades\DB;

class TallerService
{
    public array $tallers = [];

    public function getTalleresAll()
    {
        $talleres = DB::select("SELECT p.nombre as programa, tt.descripcion as tipo, t.nombre, t.estado, t.created_at as fecha
                            from tallers t
                            inner join programas p on p.id = t.programa_id
                            inner join tipo_tallers tt on tt.id = t.tipo_taller_id
                            order by t.nombre asc");
        return $talleres;
    }

    /* Metodo sin referencias */
    public function getTalleres($id)
    {
        $talleres = Taller::where('estado', true)->where('tipo_taller_id', $id)->with('programa')->orderBy('id', 'asc')->get();
        return $talleres;
    }

    /* Carga de talleres basados en personas con inscripciones en ellos */
    public function getTalleresWithInscripciones(int $id)
    {
        $talleresprogramas = DB::select("SELECT t.id AS taller_id, t.nombre AS taller_nombre FROM inscripcions i
                                                LEFT JOIN horarios h ON h.id = i.horario_id
                                                LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                                LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                                LEFT JOIN tallers t ON t.id = c.taller_id
                                                LEFT JOIN programas p ON p.id = t.programa_id
                                                WHERE p.id = ?
                                                GROUP BY t.id, t.nombre
                                                ORDER BY t.id ASC",[$id]);
        foreach($talleresprogramas as $tallerPrograma){
            $this->tallers[]=[
                'tallerid'=> $tallerPrograma->taller_id,
                'tallernombre'=> $tallerPrograma->taller_nombre,
            ];
        }

        return $this->tallers;
    }

    public function getTalleresByProgramas($id)
    {
        $talleres = Taller::where('estado', true)->where('programa_id', $id)->orderBy('id', 'asc')->get();



        return $talleres;
    }
}
