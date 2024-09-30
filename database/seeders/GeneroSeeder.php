<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = [
            'MASCULLINO',
            'FEMENINO',
            'NO INDICADO',
        ];

        foreach($generos as $genero){
            Genero::create([
                'tipo_genero'=>$genero
            ]);
        }
    }
}
