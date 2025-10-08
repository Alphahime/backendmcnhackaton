<?php
// database/migrations/2024_01_01_000000_create_galerie_oeuvres_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalerieOeuvresTable extends Migration
{
    public function up()
    {
        Schema::create('galerie_oeuvres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('artiste')->nullable();
            $table->integer('annee_creation')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galerie_oeuvres');
    }
}