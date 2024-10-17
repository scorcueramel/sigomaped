<?php

namespace App\Services;

use App\Data\TipoSeguroData;
use App\Models\TipoSeguro;

class TipoSeguroService
{

    public array $seguros = [];

    public function getTipoSerguro():array
    {
        $tiposerguro = TipoSeguro::all();

        foreach ($tiposerguro as $tipo) {
            $this->seguros[] = TipoSeguroData::from([
                'tipoguroid' => $tipo->id,
                'tiposeguro' => $tipo->tipo_seguro,
            ]);
        }

        return $this->seguros;
    }
}
