<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call([
            DepartamentosSeeder::class,
            CiudadesSeeder::class,
            tipos_documentosSeeder::class,
            tipos_personasSeeder::class,
        ]);
    }
}
