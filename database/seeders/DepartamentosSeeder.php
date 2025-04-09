<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

              // Lista de departamentos con códigos DANE
              $departamentos = [
                ['id_departamento' => '05', 'departamento' => 'ANTIOQUIA'],
                ['id_departamento' => '08', 'departamento' => 'ATLÁNTICO'],
                ['id_departamento' => '11', 'departamento' => 'BOGOTÁ, D.C.'],
                ['id_departamento' => '13', 'departamento' => 'BOLÍVAR'],
                ['id_departamento' => '15', 'departamento' => 'BOYACÁ'],
                ['id_departamento' => '17', 'departamento' => 'CALDAS'],
                ['id_departamento' => '18', 'departamento' => 'CAQUETÁ'],
                ['id_departamento' => '19', 'departamento' => 'CAUCA'],
                ['id_departamento' => '20', 'departamento' => 'CESAR'],
                ['id_departamento' => '23', 'departamento' => 'CÓRDOBA'],
                ['id_departamento' => '25', 'departamento' => 'CUNDINAMARCA'],
                ['id_departamento' => '27', 'departamento' => 'CHOCÓ'],
                ['id_departamento' => '41', 'departamento' => 'HUILA'],
                ['id_departamento' => '44', 'departamento' => 'LA GUAJIRA'],
                ['id_departamento' => '47', 'departamento' => 'MAGDALENA'],
                ['id_departamento' => '50', 'departamento' => 'META'],
                ['id_departamento' => '52', 'departamento' => 'NARIÑO'],
                ['id_departamento' => '54', 'departamento' => 'NORTE DE SANTANDER'],
                ['id_departamento' => '63', 'departamento' => 'QUINDÍO'],
                ['id_departamento' => '66', 'departamento' => 'RISARALDA'],
                ['id_departamento' => '68', 'departamento' => 'SANTANDER'],
                ['id_departamento' => '70', 'departamento' => 'SUCRE'],
                ['id_departamento' => '73', 'departamento' => 'TOLIMA'],
                ['id_departamento' => '76', 'departamento' => 'VALLE DEL CAUCA'],
                ['id_departamento' => '81', 'departamento' => 'ARAUCA'],
                ['id_departamento' => '85', 'departamento' => 'CASANARE'],
                ['id_departamento' => '86', 'departamento' => 'PUTUMAYO'],
                ['id_departamento' => '91', 'departamento' => 'AMAZONAS'],
                ['id_departamento' => '94', 'departamento' => 'GUAINÍA'],
                ['id_departamento' => '95', 'departamento' => 'GUAVIARE'],
                ['id_departamento' => '97', 'departamento' => 'VAUPÉS'],
                ['id_departamento' => '99', 'departamento' => 'VICHADA']
            ];
    


        // Insertar los departamentos en la tabla
        
        $data=[];

        foreach($departamentos as $departamento){
            $data[]=[
                'id_departamento'=>$departamento['id_departamento'],
                'departamento'=>$departamento['departamento'],
                'created_at'=>now()
             
            ];
        }

        DB::table('departamentos')->insert($data);
        // Insertar los departamentos en la tabla       



    }
}
