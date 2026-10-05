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
        Schema::table('bordereaux', function (Blueprint $table) {
            $table->foreignId('proforma_id')
                ->nullable()
                ->after('date_livraison')
                ->constrained('proformas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('bordereaux', function (Blueprint $table) {
            $table->dropForeign(['proforma_id']);
            $table->dropColumn('proforma_id');
        });
    }
};
