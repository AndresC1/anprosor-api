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
        Schema::create('detalle_operacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->index()->constrained('services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('origen', ['barco', 'campo']);
            $table->foreignId('informacion_vapor_id')->index()->nullable()->constrained('informacion_vapors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('silo_id')->index()->nullable()->constrained('silos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('producto_id')->index()->nullable()->comment('producto/grano')->constrained('grains')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('presentacion', ['granel', 'saco']);
            $table->foreignId('analisis_id')->index()->nullable()->constrained('analisis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pesaje_id')->index()->nullable()->constrained('pesajes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('observacion')->nullable();
            $table->foreignId('operacion_id')->index()->constrained('operacions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_operacions');
    }
};
