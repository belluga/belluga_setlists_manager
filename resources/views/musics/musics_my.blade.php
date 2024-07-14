@extends('layouts.main')

@section('header')
    {{-- <x-main.page_header title="Dashboard" description="Descrição qualquer" buttonLabel="Repertório" /> --}}
    <x-navbar.main title="Músicas" description="Descrição qualquer" buttonLabel="Repertório" />
@endsection

@section('main')
    <div class="flex flex-col items-end mb-4">
        <a href="{{ route('music_create') }}"><button type="button"
                class="inline-block px-3 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                <i class="fas fa-th-large"></i>
                <spán class="ml-2">Adicionar Música</span>
            </button></a>
    </div>

    <!-- table 1 -->
    <x-musics_table />
@endsection
