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
        Schema::create('pesajes', function (Blueprint $table) {
            $table->id();
            $table->float('peso_bruto', 8, 2);
            $table->float('peso_tara', 8, 2);
            $table->float('peso_neto', 8, 2);
            $table->enum('unidad_medida', ['kg', 'qq', 'ton']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesajes');
    }
};
