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
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_documento');
            $table->date('fecha_registro');
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable();
            $table->string('nombre_conductor')->nullable();
            $table->string('cedula_conductor')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_generales');
    }
};
