<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\SetlistController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/index', 'index');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('home');

    Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
    Route::get('/music_create', [MusicController::class, 'create'])->name('music_create');
    Route::post('/music_create', [MusicController::class, 'store']);
    Route::get('/musics_my', [MusicController::class, 'show_my'])->name('musics_my');
    Route::get('/musics_shared_with_me', [MusicController::class, 'show_shared_with_me'])->name('musics_shared');

    Route::get('/setlist/{setlist}', [SetlistController::class, 'show_single']);
    Route::get('/setlists_my', [SetlistController::class, 'show_my'])->name('setlists_my');
    Route::get('/setlists_shared_with_me', [SetlistController::class, 'show_shared_with_me'])->name('setlists_shared');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
