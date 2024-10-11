<?php

use App\Http\Controllers\Api\MusicApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('musics', MusicApiController::class);
});
