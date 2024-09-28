<?php

namespace Database\Seeders;

use App\Models\TipoPersona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoPersona = [
            "ADMINISTRADOR",
            "ENCARGADO",
            "PADRE",
            "MADRE",
            "ADMINISTRADOR",
            "REPRESENTANTE LEGAL"
        ];

        foreach ($tipoPersona as $tipo) {
            TipoPersona::create(['tipo_persona'=>$tipo]);
        }
    }
}
