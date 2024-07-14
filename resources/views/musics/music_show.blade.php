@extends('layouts.main')

@section('header')
    {{-- <x-main.page_header title="Dashboard" description="Descrição qualquer" buttonLabel="Repertório" /> --}}
    <x-navbar.main title="{{$music->name}}" description="Descrição qualquer" buttonLabel="Repertório" />
@endsection

@section('main')
    <div class="py-6 border-b border-coolGray-100">
        {{ $music->raw_content }}
    </div>
@endsection
