<?php

namespace App\Services;

use App\Data\PersonaInscritaData;
use App\Models\CicloHorario;
use App\Models\EsperaPersonaTaller;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InscripcionService
{

    public array $isncritos = [];

    public function getInscripcionesByTallerDia(int $tallerid, int $diaid)
    {
        $inscritotaller = DB::select("SELECT concat(p.nombres,' ',p.apellidos) as \"persona_nombres\", p.documento as \"persona_documento\" from inscripcions i
                                    left join horarios h on h.id = i.horario_id
                                    left join dias d on d.id = h.dia_id
                                    left join ciclo_horarios ch on ch.horario_id = h.id
                                    left join ciclos c on c.id = ch.ciclo_id
                                    left join personas p on p.id = i.persona_id
                                    where c.taller_id = ? and d.id = ?", [$tallerid, $diaid]);

        foreach ($inscritotaller as $inscrito) {
            $this->isncritos[] = PersonaInscritaData::from([
                'personainscritanombre' => $inscrito->persona_nombres,
                'personainscritadocumento' => $inscrito->persona_documento,
            ]);
        }

        return $this->isncritos;
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

    public function inscribirAlumno(array $alumnoinscribir)
    {
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach ($alumnoinscribir as $inscripcion) {
            $hayCupos = $this->getCuposCiclo($inscripcion->horarioid, $inscripcion->cicloid);
            if ($hayCupos) {
                $cicloInscrito = $this->getIncritosById($inscripcion->alumnoid, $inscripcion->horarioid);
                if (count($cicloInscrito) <= 0) {
                    $nuevoInscrito = new Inscripcion();
                    $nuevoInscrito->persona_id = $inscripcion->alumnoid;
                    $nuevoInscrito->horario_id = $inscripcion->horarioid;
                    $nuevoInscrito->fecha_inscripcion = $inscripcion->fechainscripcion;
                    $nuevoInscrito->usuario_actualiza = $usuarioActualiza;
                    $nuevoInscrito->save();
                    $this->updateCuposCiclo($inscripcion->horarioid, $inscripcion->cicloid);
                    $this->getPersonaEspera($inscripcion->alumnoid, $inscripcion->tallerid);
                    if ($inscripcion->enespera == "2")
                        return 100;
                    return 200;
                } else {
                    return 500;
                }
            } else {
                return 400;
            }
        }
    }

    public function getCuposCiclo($horario, $ciclo): bool
    {
        $cicloshorarios = $this->getCiclosHorariosGlobal($horario, $ciclo);

        $cupos = true;

        foreach ($cicloshorarios as $ch) {
            if ($ch->cupo_actual == 0)
                $cupos = false;
        }

        return $cupos;
    }

    public function updateCuposCiclo($horario, $ciclo)
    {
        $cicloshorarios = $this->getCiclosHorariosGlobal($horario, $ciclo);

        foreach ($cicloshorarios as $ch) {
            $ch->cupo_actual--;
            $ch->save();
        }
    }

    public function getIncritosById($alumno, $horario): Collection
    {
        $inscrito = Inscripcion::where('persona_id', $alumno)->where('horario_id', $horario)->get();
        return $inscrito;
    }

    public function getCiclosHorariosGlobal($horario, $ciclo): Collection
    {
        $cicloshorarios = CicloHorario::where('horario_id', $horario)->where('ciclo_id', $ciclo)->get();
        return $cicloshorarios;
    }

    public function getPersonaEspera(int $personaid, int $tallerid)
    {
        $personaespera = EsperaPersonaTaller::where('persona_id', $personaid)->where('taller_id', $tallerid)->get();
        foreach ($personaespera as $p) {
            $p->inscrito = 'I';
            $p->save();
        }
        return $personaespera;
    }
}
