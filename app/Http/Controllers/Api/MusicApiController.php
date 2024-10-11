<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMusicRequest;
use App\Http\Resources\MusicResource;
use App\Models\Music;

class MusicApiController extends Controller {
    public function index() {
        $musics = Music::all();
        return MusicResource::collection($musics);
    }

    public function store(StoreMusicRequest $request) {
        $music = Music::create($request->validated());
        return new MusicResource($music);
    }

    public function update(StoreMusicRequest $request, Music $music) {
        $music->update($request->validated());
        return new MusicResource($music);
    }

    public function destroy(Music $music) {
        $music->delete();
        return response(null, 204);
    }
}
