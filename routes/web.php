<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/browse_musics', [MusicController::class, 'show']);
Route::get('/browse_movies', [MovieController::class, 'show']);
