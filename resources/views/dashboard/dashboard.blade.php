@extends('layouts.main')

@section('header')
    {{-- <x-main.page_header title="Dashboard" description="Descrição qualquer" buttonLabel="Repertório" /> --}}
    <x-navbar.main title="Dashboard" description="Descrição qualquer" buttonLabel="Repertório" />
@endsection

@section('main')
    <p>This is the dashboard content</p>
@endsection
