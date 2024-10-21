<?php

namespace App\Services;

use App\Data\AnioPeriodoData;
use App\Models\AnioPeriodo;
use Exception;

class AnioPeriodoService{

    public array $aniosPeriodosList = [];

    public function getAnioPeriodosAll(){
        $anioPeriodos = AnioPeriodo::where('estado',true)->orderBy('descripcion','desc')->get();
        foreach($anioPeriodos as $ap){
            $this->aniosPeriodosList[]=AnioPeriodoData::from([
                "anioperiodoid"=> $ap->id,
                "descripcion"=> $ap->descripcion,
            ]);
        }

        return $this->aniosPeriodosList;
    }

    public function crearAnioPeriodo(array $data)
    {
        try {
            $anioPeriodo = AnioPeriodo::create($data);
            return $anioPeriodo;
        } catch (Exception $e) {
            throw new Exception('Error al crear el Periodo: ' . $e->getMessage());
        }
    }
}
