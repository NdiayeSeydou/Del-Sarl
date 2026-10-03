<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bordereaux', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique();
            $table->string('num_bl')->unique();
            $table->string('client');
            $table->date('date_livraison');
            $table->string('reference')->nullable();

            $table->string('emetteur_nom')->nullable();
            $table->string('emetteur_fonction')->nullable();
            $table->string('recepteur_nom')->nullable();
            $table->string('recepteur_fonction')->nullable();

            $table->integer('total_quantite')->default(0);
            $table->timestamps();
        });

        Schema::create('bordereau_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bordereau_id')->constrained('bordereaux')->onDelete('cascade');
            $table->text('designation');
            $table->integer('quantite');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bordereau_articles');
        Schema::dropIfExists('bordereaux');
    }
};
