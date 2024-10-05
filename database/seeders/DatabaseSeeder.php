<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            TipoPersonaSeeder::class,
            GeneroSeeder::class,
            PeriodoSeeder::class,
            AnioIngresoSeeder::class
        ]);

        // Persona::create([
        //     'tipo_persona_id' => 1,
        //     'documento' => '48398529',
        //     'nombres' => 'Sergio Alejandro',
        //     'apellidos' => 'Corcuera Mel',
        // ]);

        // User::create([
        //     'persona_id'=>1,
        //     'email'=>'scorcueramel@gmail.com',
        //     'password'=>Hash::make('administrador'),
        // ]);
    }
}
