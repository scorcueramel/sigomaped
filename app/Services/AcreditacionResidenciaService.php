<?php

namespace App\Services;

use App\Models\AcreditacionResidencia;

class AcreditacionResidenciaService
{

    public array $acreditacionesAll = [];

    public function getAcreditacionResidencias(): array
    {
        $acreditaciones = AcreditacionResidencia::all();

        foreach ($acreditaciones as $acreditacion) {
            $this->acreditacionesAll[] = [
                'acredresidid' => $acreditacion->id,
                'acreditacionresidencia' => $acreditacion->acreditacion,
            ];
        }

        return $this->acreditacionesAll;
    }
}
