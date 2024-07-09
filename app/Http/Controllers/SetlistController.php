<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class SetlistController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show_single(Music $music)
    {
        return view('setlists.setlitsts_my', [
            'musics' => Music::where('tone', "A")->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_my(Music $music)
    {
        return view('setlists.setlitsts_my', [
            'musics' => Music::where('tone', "A")->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_shared_with_me(Music $music)
    {
        return view('setlists.setlitsts_shared_with_me', [
            'musics' => Music::where('tone', "A")->get()
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
