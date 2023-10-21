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
        Schema::create('remissions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_remision')->index()->unique();
            $table->date('fecha_remision')->index();
            $table->string('remision_origen')->index()->nullable();
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable();
            $table->string('cliente')->index();
            $table->foreignId('servicio_id')->index()->constrained('services')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('vapor')->index()->nullable();
            $table->float('peso_segun_puerto', 8, 3)->nullable()->comment('peso segun puerto');
            $table->foreignId('creado_por')->index()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ultima_modificacion_por')->index()->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('silo_id')->index()->nullable()->constrained('silos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('presentacion');
            $table->foreignId('producto')->index()->constrained('grains')->cascadeOnUpdate()->cascadeOnDelete();
            $table->char('unidad_medida', 3)->index()->default('kg');
            $table->float('temperatura', 5, 2)->default(0)->nullable();
            $table->float('humedad', 5, 2)->default(0)->nullable();
            $table->float('impureza', 5, 2)->default(0)->nullable();
            $table->float('grano_quebrado', 5, 2)->default(0)->nullable();
            $table->float('grano_no_desarrollado', 5, 2)->default(0)->nullable();
            $table->string('conductor')->index();
            $table->string('placa')->index();
            $table->string('cedula_conductor')->index();
            $table->float('peso_bruto', 8, 3);
            $table->float('peso_tara', 8, 3)->nullable();
            $table->float('peso_neto', 8, 3)->nullable();
            $table->enum('movimiento', ['ingreso', 'egreso'])->index();
            $table->string('observaciones')->nullable();
            $table->enum('estado', ['completado', 'en_curso'])->index();
            $table->string('remision_general_xlsx')->nullable();
            $table->string('recibo_ingreso_xlsx')->nullable();
            $table->string('recibo_egreso_xlsx')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remissions');
    }
};
