<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\SetlistApiController;
use App\Http\Controllers\api\MusicApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/tokens/create', function(Request $request) {
       $token = $request->user()->tokens()->create(["name" => $request->name]);
       return ['token' => $token->plainTextToken];
    });

    Route::get('/test', function(Request $request) {
        dd();
        return [
            "status" => "ok"
        ];
    });

});

Route::apiResource('/setlists', SetlistApiController::class);
Route::apiResource('/musics', MusicApiController::class);
