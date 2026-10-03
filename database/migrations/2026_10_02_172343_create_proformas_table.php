<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique();
            $table->string('num_proforma')->unique();
            $table->string('client');
            $table->date('date_proforma');
            $table->string('devise', 3)->default('XOF');

            $table->boolean('appliquer_tva')->default(false);
            $table->decimal('tva_pourcentage', 5, 2)->default(18.00);
            $table->boolean('appliquer_remise')->default(false);
            $table->decimal('remise_pourcentage', 5, 2)->default(0.00);

            $table->decimal('subtotal_ht', 15, 2)->default(0.00);
            $table->decimal('montant_remise', 15, 2)->default(0.00);
            $table->decimal('montant_tva', 15, 2)->default(0.00);
            $table->decimal('grand_total', 15, 2)->default(0.00);

            $table->text('montant_lettres')->nullable();
            $table->text('remarques')->nullable();
            $table->timestamps();
        });

        Schema::create('proforma_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_id')->constrained('proformas')->onDelete('cascade');
            $table->text('designation');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 15, 2);
            $table->decimal('prix_total', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proforma_articles');
        Schema::dropIfExists('proformas');
    }
};
