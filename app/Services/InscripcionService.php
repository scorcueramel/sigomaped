<?php

namespace App\Services;

use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function inscribirAlumno(array $alumnoinscribir){
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres.' '.$obtenerUsuario[0]->persona->apellidos;

        foreach($alumnoinscribir as $inscripcion){
            $nuevoInscrito = new Inscripcion();
            $nuevoInscrito->persona_id = $inscripcion->alumnoid;
            $nuevoInscrito->horario_id = $inscripcion->horarioid;
            $nuevoInscrito->usuario_actualiza = $usuarioActualiza;
            $nuevoInscrito->save();
        }

        return 200;
    }
}
