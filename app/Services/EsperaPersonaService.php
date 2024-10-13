<?php

namespace App\Services;

use App\Data\PersonaListaEsperaData;
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
                'apellidos' => $alespera->apellidos]);
        }

        return $this->listaAlumnosEspera;
    }
}
