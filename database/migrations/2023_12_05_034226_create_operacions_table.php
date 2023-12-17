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
        Schema::create('operacions', function (Blueprint $table) {
            $table->id();
            $table->enum('movimiento', ['remision', 'ingreso', 'pesaje']);
            $table->foreignId('datos_generales_id')->index()->constrained('datos_generales')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('informacion_adicional_id')->index()->index()->constrained('informacion_adicionals')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('estado', ['en_proceso', 'finalizado', 'cancelada'])->default('en_proceso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacions');
    }
};
