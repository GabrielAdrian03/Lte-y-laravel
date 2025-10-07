<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            
            $table->string('patente')->unique();
            
            $table->foreignId('marcas_id')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('modelos_id')->constrained('modelos')->onDelete('cascade');


            //$table->unsignedBigInteger('marcas_id');
            //$table->unsignedBigInteger('modelos_id');

            //$table->foreign('marcas_id')->references('id')->on('marcas')->onDelete('cascade');
            //$table->foreign('modelos_id')->references('id')->on('modelos')->onDelete('cascade');

            $table->date('fecha_vtv');
            $table->string('estado');
            $table->date('fecha_cambio_neumaticos');
            $table->integer('cantidad_puertas');
            $table->integer('anio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
};
