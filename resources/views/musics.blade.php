@extends('layouts.main')

@section('main')
    @forelse ($musics as $music)
        <p>
            Name: {{ $music->name }}<br>
            Tone: {{ $music->tone }}<br>
            {{-- Year: {{ $music->year }}<br>
  Runtime: {{ $music->runtime }}<br>
  IMDB Rating: {{ $music->imdb['rating'] }}<br>
  IMDB Votes: {{ $movie->imdb['votes'] }}<br>
  Plot: {{ $music->plot }}<br> --}}
        </p>
    @empty
        <p>No results</p>
    @endforelse
@endsection
