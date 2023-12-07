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
        Schema::create('analisis', function (Blueprint $table) {
            $table->id();
            $table->float('temperatura', 3, 2);
            $table->float('humedad', 4, 2);
            $table->float('impurezas', 4, 2);
            $table->integer('grano_quebrado');
            $table->integer('grano_no_desarrollado');
            $table->integer('hongo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis');
    }
};
