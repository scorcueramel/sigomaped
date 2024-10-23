<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CalendarioService
{

    public array $calendarioLista = [];

    public function getCalendarioLista(int $tipoTallerid, int $porgramaid, int $tallerid): array
    {

        $listacalendario = DB::select("SELECT * FROM calendario_listar(?,?,?)", [$tipoTallerid, $porgramaid, $tallerid]);
        foreach ($listacalendario as $lista) {
            $this->calendarioLista[] = [
                'title' => $lista->title,
                'start' => $lista->fecha_inicio,
                'end' => $lista->fecha_fin,
                'dia' => $lista->dia,
                'cicloid' => $lista->ciclo_id,
                'anio' => $lista->anio,
                'periodo' => $lista->periodo,
                'tallerid' => $lista->taller_id,
                'taller' => $lista->taller,
                'programaid' => $lista->programa_id,
                'programa' => $lista->programa,
            ];
        }

       return $this->calendarioLista;
    }
}
