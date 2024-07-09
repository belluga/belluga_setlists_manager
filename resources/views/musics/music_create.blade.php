@extends('layouts.main')

@section('header')
    <x-main.page_header title="Adicionar Música" description="Descrição qualquer" buttonLabel="Salvar"
        buttonRoute="music_create">
        <x-main.add_button label="Salvar Música" type="submit" form="music_create" />
    </x-main.page_header>
@endsection

@section('main')
    <form id="music_create" method="post" action="{{ route('music_create') }}">
        @csrf
        <div class="py-6 border-b border-coolGray-100">
            <div class="w-full md:w-9/12">
                <div class="flex flex-wrap -m-3">
                    <div class="w-full md:w-1/3 p-3">
                        <p class="text-sm text-coolGray-800 font-semibold">Nome da Música</p>
                    </div>
                    <div class="w-full md:flex-1 p-3">
                        <input name="name"
                            class="w-full px-4 py-2.5 text-base text-coolGray-900 font-normal outline-none focus:border-green-500 border border-coolGray-200 rounded-lg shadow-input"
                            type="text" placeholder="Hey Jude">
                        @error('name')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="py-6 border-b border-coolGray-100">
            <div class="w-full md:w-9/12">
                <div class="flex flex-wrap -m-3">
                    <div class="w-full md:w-1/3 p-3">
                        <p class="text-sm text-coolGray-800 font-semibold">Tom</p>
                    </div>
                    <div class="w-full md:flex-1 p-3">
                        <div class="relative">
                            <svg class="absolute right-4 top-1/2 transform -translate-y-1/2" width="16" height="16"
                                viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.3333 6.1133C11.2084 5.98913 11.0395 5.91943 10.8633 5.91943C10.6872 5.91943 10.5182 5.98913 10.3933 6.1133L8.00001 8.47329L5.64001 6.1133C5.5151 5.98913 5.34613 5.91943 5.17001 5.91943C4.99388 5.91943 4.82491 5.98913 4.70001 6.1133C4.63752 6.17527 4.58792 6.249 4.55408 6.33024C4.52023 6.41148 4.50281 6.49862 4.50281 6.58663C4.50281 6.67464 4.52023 6.76177 4.55408 6.84301C4.58792 6.92425 4.63752 6.99799 4.70001 7.05996L7.52667 9.88663C7.58865 9.94911 7.66238 9.99871 7.74362 10.0326C7.82486 10.0664 7.912 10.0838 8.00001 10.0838C8.08801 10.0838 8.17515 10.0664 8.25639 10.0326C8.33763 9.99871 8.41136 9.94911 8.47334 9.88663L11.3333 7.05996C11.3958 6.99799 11.4454 6.92425 11.4793 6.84301C11.5131 6.76177 11.5305 6.67464 11.5305 6.58663C11.5305 6.49862 11.5131 6.41148 11.4793 6.33024C11.4454 6.249 11.3958 6.17527 11.3333 6.1133Z"
                                    fill="#8896AB"></path>
                            </svg>
                            <select name="tone"
                                class="appearance-none w-full py-2.5 px-4 text-coolGray-900 text-base font-normal bg-white border outline-none border-coolGray-200 focus:border-green-500 rounded-lg shadow-input">
                                <option>Selecione o tom</option>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-6">
            <div class="w-full md:w-9/12">
                <div class="flex flex-wrap -m-3">
                    <div class="w-full md:w-1/3 p-3">
                        <p class="text-sm text-coolGray-800 font-semibold">Letra + Cifra</p>
                        <p class="text-xs text-coolGray-500 font-medium">Insira a cifra com [D] onde quer que seja exibida.
                        </p>
                    </div>
                    <div class="w-full md:flex-1 p-3">
                        @error('raw_content')
                            <p>{{ $message }}</p>
                        @enderror
                        <textarea name="raw_content" placeholder="[A]Hey jude, [B]don't let"
                            class="block w-full h-64 p-6 text-base text-coolGray-900 font-normal outline-none focus:border-green-500 border border-coolGray-200 rounded-lg shadow-input resize-none"></textarea>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection
