@extends('layouts.main')

@section('header')
    <x-main.page_header title="Músicas Compartilhadas Comigo" description="Descrição qualquer">
        {{-- <x-main.add_button label="Adicionar Música" route="music_create" /> --}}
    </x-main.page_header>
@endsection

@section('main')
    <section class="bg-coolGray-50 py-4">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap -m-3">
                @foreach ($musics as $music)
                    <p>{{$music->name}}</p>
{{--                    <x-musics.music_card :music='$music' />--}}
                @endforeach
            </div>
        </div>
    </section>
@endsection
