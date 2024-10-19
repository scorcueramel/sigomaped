<?php

namespace App\Services;

use App\Data\TiposTalleresData;
use App\Models\TipoTaller;

class TipoTallerService
{

    public array $tiposTalleres = [];

    public function getTiposTalleres()
    {
        $talleresTipos = TipoTaller::all();

        foreach ($talleresTipos as $tallerTipo) {
            $this->tiposTalleres[] = TiposTalleresData::from([
                'tipotallerid' => $tallerTipo->id,
                'tipotallerdescripcion' => $tallerTipo->descripcion,
                'tipotallerusuact' => $tallerTipo->usuario_actualiza,
            ]);
        }

        return $this->tiposTalleres;
    }
}
