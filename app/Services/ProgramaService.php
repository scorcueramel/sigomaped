<?php

namespace App\Services;

use App\Data\ProgramaData;
use App\Models\Programa;
use Exception;
use Illuminate\Support\Facades\DB;

class ProgramaService
{

    public array $programas = [];

    public function getProgramasAll()
    {
        $programas = Programa::all();
        return $programas;
    }

    public function getProgramasWithInscritos()
    {
        $programas = DB::select('SELECT p.id, p.nombre  FROM inscripcions i
                                        LEFT JOIN horarios h ON h.id = i.horario_id
                                        LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                        LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                        LEFT JOIN tallers t ON t.id = c.taller_id
                                        LEFT JOIN programas p ON p.id = t.programa_id
                                        GROUP BY p.id, p.nombre
                                        ORDER BY p.id ASC');
        return $programas;
    }

    public function getValidateInscriptionUser($tipo_programa, $alumno_id)
    {
        $validation = DB::select("SELECT
                                            p.id AS \"persona_id\",
                                            t.id AS \"taller_id\",
                                            t.tipo_taller_id AS \"tipo_taller\"
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
                                        WHERE p.id = ? AND t.tipo_taller_id = ? AND i.estado_inscripcion = 'I';", [$alumno_id, $tipo_programa]);

        return $validation;
    }

    public function getProgramas($id)
    {
        $programas = DB::select('SELECT p.id, p.nombre FROM tallers t
                                        LEFT JOIN programas p ON p.id = t.programa_id
                                        LEFT JOIN tipo_tallers tt ON tt.id = t.tipo_taller_id
                                        WHERE tt.id = ?
                                        GROUP BY p.id, p.nombre', [$id]);
        return $programas;
    }

    public function getProgramasByTipoTaller(int $tipotallerid)
    {
        $programasByTipo = DB::select("SELECT p.id ,p.nombre FROM inscripcions i
                                                LEFT JOIN horarios h ON h.id = i.horario_id
                                                LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                                LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                                LEFT JOIN tallers t ON t.id = c.taller_id
                                                LEFT JOIN tipo_tallers tt ON tt.id = t.tipo_taller_id
                                                LEFT JOIN programas p ON p.id = t.programa_id
                                                WHERE tt.id = ?
                                                GROUP BY p.id, p.nombre", [$tipotallerid]);

        foreach ($programasByTipo as $pt) {
            $this->programas[] = ProgramaData::from([
                'programaid' => $pt->id,
                'nombre' => $pt->nombre,
            ]);
        }

        return $this->programas;
    }

    public function crearPrograma(array $data)
    {
        try {
            $programa = Programa::create($data);
            return $programa;
        } catch (Exception $e) {
            throw new Exception('Error al crear el programa: ' . $e->getMessage());
        }
    }
}
