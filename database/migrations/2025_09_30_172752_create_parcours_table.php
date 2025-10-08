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
Schema::create('parcours', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('image_url')->nullable();
    $table->enum('difficulty', ['facile', 'moyen', 'difficile'])->default('facile');
    $table->integer('estimated_duration')->nullable(); // en minutes
    $table->enum('target_audience', ['enfants', 'scolaires', 'adultes', 'experts'])->default('adultes');
    $table->boolean('is_featured')->default(false);
    $table->integer('order')->default(0);
    $table->json('themes')->nullable(); // ["histoire", "art", "religion"]
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcours');
    }
};
