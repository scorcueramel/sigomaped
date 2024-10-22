<?php

namespace App\Services;

use App\Data\TipoDiscapacidadData;
use App\Models\TipoDiscapacidad;

class TipoDiscapacidadService
{

    public array $tiposDiscapacidades = [];

    public function getTiposDiscapacidadesAll(): array
    {
        $tiposdiscapacidades = TipoDiscapacidad::all();
        foreach ($tiposdiscapacidades as $tpd) {
            $this->tiposDiscapacidades[] = TipoDiscapacidadData::from([
                'tipodiscapacidadid' => $tpd->id,
                'tipodiscapacidad' => $tpd->tipo_discapacidad,
                'tipodiscapacidadmensaje' => '',
            ]);
        }
        return $this->tiposDiscapacidades;
    }
}
