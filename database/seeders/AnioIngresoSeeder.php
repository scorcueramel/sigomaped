<?php

namespace Database\Seeders;

use App\Models\AnioIngreso;
use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnioIngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anios = ['2020','2021','2022','2023','2024'];
        $periodos = ['1','2'];

        foreach($anios as $anio){
            foreach($periodos as $periodo){
                AnioIngreso::create([
                    'periodo_id' => $periodo,
                    'anio' => $anio,
                ]);
            }
        }
    }
}
