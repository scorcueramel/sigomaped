<?php

namespace App\Services;

use App\Data\DistritosData;

class DistritosService
{

    public array $distritos = [];

    public function distritosLimaArray()
    {

        $distritosLima = [
            0 => ["Lima", "150101"],
            1 => ["Ancon", "150102"],
            2 => ["Ate", "150103"],
            3 => ["Barranco", "150104"],
            4 => ["Breña", "150105"],
            5 => ["Carabayllo", "150106"],
            6 => ["Chaclacayo", "150107"],
            7 => ["Chorrillos", "150108"],
            8 => ["Cieneguilla", "150109"],
            9 => ["Comas", "150110"],
            10 => ["El Agustino", "150111"],
            11 => ["Independencia", "150112"],
            12 => ["Jesus Maria", "150113"],
            13 => ["La Molina", "150114"],
            14 => ["La Victoria", "150115"],
            15 => ["Lince", "150116"],
            16 => ["Los Olivos", "150117"],
            17 => ["Lurigancho", "150118"],
            18 => ["Lurin", "150119"],
            19 => ["Magdalena Del Mar", "150120"],
            20 => ["Miraflores", "150122"],
            21 => ["Pachacamac", "150123"],
            22 => ["Pucusana", "150124"],
            23 => ["Pueblo Libre", "150121"],
            24 => ["Puente Piedra", "150125"],
            25 => ["Punta Hermosa", "150126"],
            26 => ["Punta Negra", "150127"],
            27 => ["Rimac", "150128"],
            28 => ["San Bartolo", "150129"],
            29 => ["San Borja", "150130"],
            30 => ["San Isidro", "150131"],
            31 => ["San Juan De Lurigancho", "150132"],
            32 => ["San Juan De Miraflores", "150133"],
            33 => ["San Luis", "150134"],
            34 => ["San Martin De Porres", "150135"],
            35 => ["San Miguel", "150136"],
            36 => ["Santa Anita", "150137"],
            37 => ["Santa Maria Del Mar", "150138"],
            38 => ["Santa Rosa", "150139"],
            39 => ["Santiago De Surco", "150140"],
            40 => ["Surquillo", "150141"],
            41 => ["Villa El Salvador", "150142"],
            42 => ["Villa Maria Del Triunfo", "150143"]
        ];

        foreach ($distritosLima as $key => $value) {
            $this->distritos[] = DistritosData::from([
                'distrito' => $distritosLima[$key][0],
                'codigopostal' => $distritosLima[$key][1],
            ]);
        }

        return $this->distritos;
    }
}
