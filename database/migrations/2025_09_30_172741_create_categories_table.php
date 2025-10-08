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
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique(); // Essentiel pour les URLs
    $table->text('description')->nullable(); // Pour expliquer la catégorie
    $table->string('color')->default('#6B7280'); // Pour l'UI
    $table->integer('order')->default(0); // Pour ordonner l'affichage
    $table->boolean('is_active')->default(true); // Pour activer/désactiver
    $table->timestamps();
});

        // Ajouter la clé étrangère à la table oeuvres
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
 
        
        Schema::dropIfExists('categories');
    }
};