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
        Schema::create('informacion_vapors', function (Blueprint $table) {
            $table->id();
            $table->string('vapor')->index()->comment('Nombre del barco');
            $table->string('remision_origen')->index()->comment('Remisión de origen');
            $table->float('peso_segun_puerto', 8, 2)->nullable()->comment('Peso según puerto');
            $table->enum('unidad_medida', ['kg', 'qq', 'ton'])->comment('Unidad de medida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_vapors');
    }
};
