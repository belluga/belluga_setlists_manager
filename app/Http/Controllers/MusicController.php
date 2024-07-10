<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicGenre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('musics.music_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => ["required", "min:2", "max:255"],
                "tone" => ["required", Rule::in(["A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#"])],
                "raw_content" => ["required", "min:10"],
            ]
        );

        $music = Music::create(
            ['owner' => Auth::id(), ...$validated_data]
        );

        $genre = new MusicGenre();
        $genre->name = "Rock Alternativo";
        $genre->parent = "Rock";

        $music->genres()->attach($genre);

        return redirect()->route('music.show', ['music' => $music]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        return view('musics.music_show', [
            'music' => $music
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_my()
    {

        $musics = Auth::user()->musics;

        return view('musics.musics_my', [
            'musics' => $musics,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_shared_with_me(Music $music)
    {
        $music_sharings = Auth::user()->musics_shared_with_me;

        $musics = [];

        foreach ($music_sharings as $sharing) {
            $musics[] =  $sharing->object;
        }

        return view('musics.musics_shared_with_me', [
            'musics' => $musics,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        //
    }
}
