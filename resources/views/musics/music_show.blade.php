@extends('layouts.main')

@section('header')
    <x-main.page_header title="{{ $music->name }}" description="Tom: {{ $music->tone }}" buttonLabel="Salvar"
        buttonRoute="music_create">
        <x-main.add_button label="Salvar Música" type="submit" form="music_create" />
    </x-main.page_header>
@endsection

@section('main')
    <div class="py-6 border-b border-coolGray-100">
        {{ $music->raw_content }}
    </div>
@endsection