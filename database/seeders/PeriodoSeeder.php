<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $periodos = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
        ];

        foreach($periodos as $periodo){
            Periodo::create([
                'periodo'=>$periodo
            ]);
        }
    }
}
