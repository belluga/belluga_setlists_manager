@extends('layouts.main')

@section('header')
    {{-- <x-main.page_header title="Dashboard" description="Descrição qualquer" buttonLabel="Repertório" /> --}}
    <x-navbar.main title="{{ $music->name }}" description="Descrição qualquer" buttonLabel="Repertório" />
@endsection

@section('main')
    <div class="py-6 border-b border-coolGray-100" style="display:none" id="song_raw">
        {{ $music->raw_content }}
    </div>
@endsection

@section('scripts')
    <script src="{{ env('APP_URL') }}/assets/js/plugins/ChordSheetJs.js"></script>
    <script>
        // $(document).ready(function() {
            console.log("ready");
            const songRawDiv = document.getElementById('song_raw');
            const originalValue = songRawDiv.innerHTML;
            console.log(songRawDiv);
            const parser = new ChordSheetJS.ChordProParser();
            const song = parser.parse(originalValue);
            const formatter = new ChordSheetJS.HtmlTableFormatter();
            
            console.log(originalValue);
            const disp = formatter.format(song);
            // console.log(disp);
            console.log('sssss')
            songRawDiv.innerHTML = disp;
            songRawDiv.style.display ="block";
        // });
    </script>
@endsection
