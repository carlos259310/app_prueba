<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $ciudades = [
            ['id_ciudad' => '05001', 'ciudad' => 'MEDELLÍN', 'id_departamento' => '05'],
            ['id_ciudad' => '08001', 'ciudad' => 'BARRANQUILLA', 'id_departamento' => '08'],
            ['id_ciudad' => '11001', 'ciudad' => 'BOGOTÁ, D.C.', 'id_departamento' => '11'],
            ['id_ciudad' => '13001', 'ciudad' => 'CARTAGENA', 'id_departamento' => '13'],
            ['id_ciudad' => '15001', 'ciudad' => 'TUNJA', 'id_departamento' => '15'],
            // Agrega más ciudades según sea necesario
            // Valle del Cauca
            ['id_ciudad' => '76001', 'ciudad' => 'CALI', 'id_departamento' => '76'],
            ['id_ciudad' => '68001', 'ciudad' => 'BUCARAMANGA', 'id_departamento' => '68'],

        ];
        //declaro el array data
        $data=[];

        foreach ($ciudades as $ciudad) {
            $data[] = [
                'id_ciudad' => $ciudad['id_ciudad'],
                'ciudad' => $ciudad['ciudad'],
                'id_departamento' => $ciudad['id_departamento']

            ];
        }
    
        DB::table('ciudades')->insert($data);
        // Insertar los departamentos en la tabla     
    
    }   
}
