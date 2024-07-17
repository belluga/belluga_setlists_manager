<?php

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Music;
use App\Models\Setlist;
use App\Models\User;
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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('tone', length: "3");
            $table->json('play_settings')->default(json_encode(array()));
            $table->text('lyrics');
            $table->foreignIdFor(User::class, 'owner');
            $table->timestamps();
        });

        Schema::create('setlists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->foreignIdFor(User::class, 'owner');
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignIdFor(Genre::class, 'parent_id');
            $table->foreignIdFor(User::class, 'creator_id');
            $table->timestamps();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('avatar_url')->nullable();
            $table->text('bio')->nullable();
            $table->date('birth')->nullable();
            $table->date('death')->nullable();
            $table->string('country', length: 2)->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->foreignIdFor(User::class, 'creator_id');
            $table->timestamps();
        });

        Schema::create('setlist_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Setlist::class, 'setlist_id');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        Schema::create('music_user', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Music::class, 'music_id');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        Schema::create('music_setlist', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Music::class, 'music_id');
            $table->foreignIdFor(Setlist::class, 'setlist_id');
            $table->json('play_settings')->nullable();
            $table->timestamps();
        });

        Schema::create('artist_music', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignIdFor(Music::class, 'music_id');
            $table->foreignIdFor(Artist::class, 'artist_id');
            $table->timestamps();
        });

        Schema::create('music_artist', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Music::class, 'music_id');
            $table->string('relation');
            $table->foreignIdFor(Artist::class, 'artist_id');
            $table->timestamps();
        });

        Schema::create('genre_music', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Genre::class, 'genre_id');
            $table->foreignIdFor(Music::class, 'music_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sharing_objects');
        Schema::dropIfExists('music_setlist');
        Schema::dropIfExists('artist_music');
        Schema::dropIfExists('genre_music');
        Schema::dropIfExists('music_artist');
    }
};
