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
        Schema::create('oeuvres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_fr');
            $table->text('description_en')->nullable();
            $table->text('description_wo')->nullable();
            $table->json('images')->nullable(); 
            $table->string('video_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('qr_code')->unique();
                    $table->foreignId('category_id')
              ->nullable()
              ->constrained('categories')
              ->onDelete('set null');
              
        $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oeuvres');
    }
};