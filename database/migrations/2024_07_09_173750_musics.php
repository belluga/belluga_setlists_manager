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
        Schema::create('musics', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->string('tone');
            $table->longText('raw_content');
            $table->bigInteger('owner');
            $table->json('shared_with')->nullable();
            $table->timestamps();
        });

        Schema::create('music_genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('parent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
        Schema::dropIfExists('music_genres');
    }
};
