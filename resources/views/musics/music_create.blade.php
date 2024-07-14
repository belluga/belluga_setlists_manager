@extends('layouts.main')

@section('header')
    <x-navbar.main title="Adicionar Música" description="Descrição qualquer" buttonLabel="Repertório" />
@endsection

@section('main')
    <form id="music_create" method="post" action="{{ route('music_create') }}">
        @csrf
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nome da Música</label>
        <div class="mb-4">
            <input name="name"
                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                type="text" placeholder="Hey Jude">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Intérprete</label>
        <div class="mb-4">
            <input name="interpreter"
                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                type="text" placeholder="The Beatles">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Tom</label>
        <div class="mb-4">
            <select placeholder="Selecione o tom" name="tone"
                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                <option hidden disabled selected value>Selecione o tom</option>
                <option>A</option>
                <option>A#</option>
                <option>B</option>
                <option>C</option>
                <option>C#</option>
                <option>D</option>
                <option>D#</option>
                <option>E</option>
                <option>F</option>
                <option>F#</option>
                <option>G</option>
                <option>G#</option>
            </select>
            @error('tone')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Letra + Cifra</label>
        <div class="mb-8">
            @error('raw_content')
                <p>{{ $message }}</p>
            @enderror
            <textarea rows=20 name="raw_content" placeholder="[A]Hey jude, [B]don't let"
                class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"></textarea>
        </div>
        <button type="submit"
            class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Salvar Música</button>

    </form>
@endsection
