<?php

namespace App\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreModelo');
            //$table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->unsignedBigInteger('marca_id');
            $table->timestamps();

                        // ✅ relación con marcas.id
            $table->foreign('marca_id')
                  ->references('id')
                  ->on('marcas')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
