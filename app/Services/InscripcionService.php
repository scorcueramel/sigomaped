<?php

namespace App\Services;

use App\Models\CicloHorario;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InscripcionService
{
    public function __construct(
        EsperaPersonaService $esperaPersonaService,
    ){}


    public function getDiasInscritos($id)
    {
        $dias = DB::select("SELECT
                                        d.id, d.dia
                                    FROM inscripcions i
                                    LEFT JOIN personas p ON p.id = i.persona_id
                                    LEFT JOIN horarios h ON h.id = i.horario_id
                                    LEFT JOIN dias d ON d.id = h.dia_id
                                    LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                    LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                    WHERE c.id = ?
                                    GROUP BY d.id, d.dia
                                    ORDER BY d.id ASC", [$id]);
        return $dias;
    }

    public function getInscritos($id)
    {
        $inscritos = DB::select("SELECT CONCAT(p.nombres,' ',p.apellidos) as \"nombres\", d.dia, h.hora_inicio, h.hora_fin
                                        FROM inscripcions i
                                        LEFT JOIN personas p ON p.id = i.persona_id
                                        LEFT JOIN horarios h ON h.id = i.horario_id
                                        LEFT JOIN dias d ON d.id = h.dia_id
                                        LEFT JOIN ciclo_horarios ch ON ch.horario_id = h.id
                                        LEFT JOIN ciclos c ON c.id = ch.ciclo_id
                                        WHERE c.id = ?", [$id]);
        return $inscritos;
    }

    // validar la cantidad de cupos_actuales antes de realizar la inscripcion

    public function inscribirAlumno(array $alumnoinscribir)
    {
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach ($alumnoinscribir as $inscripcion) {
            $hayCupos = $this->getCuposCiclo($inscripcion->horarioid,$inscripcion->cicloid);

            if($hayCupos){
                $nuevoInscrito = new Inscripcion();
                $nuevoInscrito->persona_id = $inscripcion->alumnoid;
                $nuevoInscrito->horario_id = $inscripcion->horarioid;
                $nuevoInscrito->fecha_inscripcion = $inscripcion->fechainscripcion;
                $nuevoInscrito->usuario_actualiza = $usuarioActualiza;
                $nuevoInscrito->save();
                $this->updateCuposCiclo($inscripcion->horarioid,$inscripcion->cicloid);
                return 200;
            }else{
                return 400;
            }
        }

    }

    public function getCuposCiclo($horario,$ciclo):bool {
        $cicloshorarios = CicloHorario::where('horario_id',$horario)->where('ciclo_id',$ciclo)->select('cupo_actual')->get();

        foreach ($cicloshorarios as $ch) {
            if($ch->cupo_actual == 0)
                $cupos = false;
        }

        return $cupos;
    }

    public function updateCuposCiclo($horario,$ciclo){
        $cicloshorarios = CicloHorario::where('horario_id',$horario)->where('ciclo_id',$ciclo)->get();

        foreach ($cicloshorarios as $ch) {
            $ch->cupo_actual = $ch->cupo_actual - 1;
            $ch->save();
        }
    }
}
