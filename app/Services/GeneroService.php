<?php

namespace App\Services;

use App\Data\GeneroData;
use App\Models\Genero;

class GeneroService
{

    public array $generos = [];

    public function getGeneros()
    {
        $generosTodos = Genero::all();

        foreach ($generosTodos as $genero) {
            $this->generos[] = GeneroData::from([
                'generoid' => $genero->id,
                'generotipo' => $genero->tipo_genero,
            ]);
        }

        return $this->generos;
    }
}
