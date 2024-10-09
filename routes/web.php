<?php

use App\Http\Controllers\Api\MusicApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\Api\SetlistApiController;
use App\Http\Controllers\SetlistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/index', '/new/index')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('home');

    Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
    Route::get('/music_create', [MusicController::class, 'create'])->name('music_create');
    Route::post('/music_create', [MusicController::class, 'store']);
    Route::get('/musics', [MusicController::class, 'show_my'])->name('musics');
    Route::get('/musics_my', [MusicController::class, 'show_my'])->name('musics_my');
    Route::get('/musics_shared_with_me', [MusicController::class, 'show_shared_with_me'])->name('musics_shared');

    Route::get('/setlist/{setlist}', [SetlistController::class, 'show_single']);
    Route::get('/setlists', [SetlistController::class, 'show_my'])->name('setlists');
    Route::get('/setlists', [SetlistController::class, 'show_my'])->name('setlist_create');
    Route::post('/setlists', [SetlistController::class, 'show_my']);
    Route::get('/setlists_my', [SetlistController::class, 'show_my'])->name('setlists_my');
    Route::get('/setlists_shared_with_me', [SetlistController::class, 'show_shared_with_me'])->name('setlists_shared');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('api')->group(function () {
    Route::get('/api/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/api/setlists', SetlistApiController::class);
    Route::apiResource('/api/musics', MusicApiController::class);
});
