<?php

namespace App\Orchid\Screens\Music;

use App\DataTables\MusicsDataTable;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\Music\MusicListLayout;

class MusicListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'musics' => Auth::user()->musics,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Minhas músicas';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Adicionar nova')
                ->icon('pencil')
                ->route('platform.music.edit')
        ];
    }

    public function dataTable(MusicsDataTable $datatable){

    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            MusicListLayout::class
        ];
    }
}
