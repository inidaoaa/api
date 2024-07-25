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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('url_video');
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('genre_film', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_film');
            $table->unsignedBigInteger('id_genre');
            $table->foreign('id_film')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('id_genre')->references('id')->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('aktor_film', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_actor');
            $table->unsignedBigInteger('id_film');
            $table->foreign('id_actor')->references('id')->on('actors')->onDelete('cascade');
            $table->foreign('id_film')->references('id')->on('films')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
        Schema::dropIfExists('genre_films');
        Schema::dropIfExists('aktor_films');
    }
};
