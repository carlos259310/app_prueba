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
        Schema::create('clientes', function (Blueprint $table) {
            //$table-> id('id_cliente');
            $table->bigIncrements('id_cliente'); // Autoincrementable
            $table->string('nombre_1',30)->nullable();;
            $table->string('nombre_2',30)->nullable();
            $table->string('apellido_1',30)->nullable();;
            $table->string('apellido_2',30)->nullable();
            $table->string('tipo_documento',10)->nullable();
            $table->string('numero_documento',20)->nullable();
            $table->string('tipo_cliente',10)->nullable();
            $table->string('tipo_persona',10)->nullable();
            $table->string('razon_social',120)->nullable();
            $table->string('email',100)->unique();
            $table->string('telefono',15);
            $table->string('direccion',255);
            $table->string('ciudad',10);
            $table->string('departamento',10);
            $table->boolean('activo')->default(1);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
