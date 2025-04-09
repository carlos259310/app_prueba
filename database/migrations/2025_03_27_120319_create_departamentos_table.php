<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //creo departamentos
        Schema::create('departamentos', function (Blueprint $table) {


            $table->string('id_departamento', 10)->primary();
            $table->string('departamento', 50);
            $table->timestamps();
        });


        Schema::create('ciudades', function (Blueprint $table) {


            $table->string('id_ciudad', 10)->primary();
            $table->string('ciudad', 50);
            $table->string('id_departamento', 10);
            $table->timestamps();

            $table->foreign('id_departamento')
                ->references('id_departamento')
                ->on('departamentos')
                ->onDelete('cascade'); // Eliminar en cascada si el departamento es eliminado

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('departamentos');

        Schema::dropIfExists('ciudades');
    }
};
