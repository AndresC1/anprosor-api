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
        Schema::table('remissions', function (Blueprint $table) {
            $table->foreignId('client_id')->index()->nullable()->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dropColumn('cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remissions', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
            $table->string('cliente')->index();
        });
    }
};
