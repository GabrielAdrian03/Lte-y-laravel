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
            Schema::create('descripciones_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('estado_general');
            $table->text('piezas_daniadas');
            $table->decimal('precio_servicio', 10, 2);
            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descripciones_vehiculo');
    }
};
