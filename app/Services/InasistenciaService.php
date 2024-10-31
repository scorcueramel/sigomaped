<?php

namespace App\Services;

use App\Models\Asistencia;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InasistenciaService {

    public function storeInasistencias(array $inasistencias):int{
        $obtenerUsuario = User::find(Auth::id())->with('persona')->get();
        $usuarioActualiza = $obtenerUsuario[0]->persona->nombres . ' ' . $obtenerUsuario[0]->persona->apellidos;

        foreach($inasistencias as $i){
            $nuevaInasistencia = new Asistencia();
            $nuevaInasistencia->inscripcion_id = $i->inscripcionid;
            $nuevaInasistencia->fecha = $i->asistenciafecha;
            $nuevaInasistencia->inasistio = $i->asistenciaasistio;
            $nuevaInasistencia->justificada = $i->asistenciajustificada;
            $nuevaInasistencia->motivo = $i->asistenciamotivo;
            $nuevaInasistencia->usuario_actualiza = $usuarioActualiza;
            $nuevaInasistencia->save();

            $totalAsistemcias = DB::select("SELECT count(inasistio) as total_inasistencias from asistencias a where inscripcion_id = ?",[ $i->inscripcionid]);

            if($totalAsistemcias >= 3){
                $incripcion = Inscripcion::leftJoin('asistencias','asistencias.inscripcion_id','=','inscripcions.id')->where('asistencias.inscripcion_id','=',$i->inscripcionid)->groupBy('inscripcions.persona_id')->select('inscripcions.persona_id')->get();

                foreach($incripcion as $inscrip){
                    DB::select("UPDATE inscripcions SET estado_inscripcion='R' WHERE persona_id = ?;",[$inscrip->persona_id]);
                }
            }
        }

        return 200;
    }
}
