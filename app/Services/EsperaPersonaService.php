<?php

namespace App\Services;

use App\Data\DatosAlumnoEsperaData;
use App\Data\PersonaListaEsperaData;
use App\Models\EsperaPersonaTaller;
use App\Models\Persona;
use App\Models\Taller;
use Illuminate\Support\Facades\DB;

class EsperaPersonaService
{
    public array $listaAlumnosEspera = [];

    public function getListaEsperaPersonasByTallerId($id)
    {
        $alumnosEspera = DB::select("SELECT
                                                p.id AS \"persona_id\", t.id AS \"taller_id\", p.documento , p.nombres , p.apellidos
                                            FROM espera_persona_tallers ept
                                            LEFT JOIN personas p ON p.id = ept.persona_id
                                            LEFT JOIN tallers t ON t.id = ept.taller_id
                                            WHERE ept.taller_id = ?", [$id]);
        foreach ($alumnosEspera as $alespera) {
            $this->listaAlumnosEspera[] = PersonaListaEsperaData::from([
                'personaid' => $alespera->persona_id,
                'tallerid' => $alespera->taller_id,
                'documento' => $alespera->documento,
                'nombres' => $alespera->nombres,
                'apellidos' => $alespera->apellidos
            ]);
        }

        return $this->listaAlumnosEspera;
    }

    public function getListaEsperaDetalle(int $personaid, int $tallerid):array
    {
        $alumno = Persona::find($personaid);
        $datotaller = Taller::where('id', $tallerid)->with('tipo_taller')->with('programa')->get()[0];
        $this->listaAlumnosEspera[] = DatosAlumnoEsperaData::from([
            'alumnoid' => $alumno->id,
            'alumnonombres' => $alumno->nombres,
            'alumnoapellidos' => $alumno->apellidos,
            'alumnodocumento' => $alumno->documento,
            'tipotallerid' => $datotaller->tipo_taller->id,
            'tipotallerdescripcion' => $datotaller->tipo_taller->descripcion,
            'programaid' => $datotaller->programa->id,
            'programanombre' => $datotaller->programa->nombre,
            'tallerid' => $datotaller->id,
            'tallernombre' => $datotaller->nombre,
        ]);

        return $this->listaAlumnosEspera;
    }

    public function updateEstadoPersonaEspera(int $personaid, int $tallerid){
        $personaEspera = EsperaPersonaTaller::where('persona_id', $personaid)->where('taller_id',$tallerid)->get();
        foreach($personaEspera as $espera){
            $espera->inscrito = 'D';
            $espera->save();
        }
        return 200;
    }
}
