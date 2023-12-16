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
        Schema::table('detalle_operacions', function (Blueprint $table) {
            $table->foreignId('archivos_id')->index()->nullable()->constrained('archivos')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_operacions', function (Blueprint $table) {
            $table->dropForeign(['archivos_id']);
            $table->dropColumn('archivos_id');
        });
    }
};
