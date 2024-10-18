<?php

namespace App\Services;

use App\Models\AnioPeriodo;
use Exception;

class AnioPeriodoService{
    public function getAnioPeriodosAll(){
        $anioPeriodos = AnioPeriodo::all();
        return $anioPeriodos;
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
