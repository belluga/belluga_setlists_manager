<?php

namespace App\Orchid\Layouts\Music;

use App\Models\Music;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MusicListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'musics';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Nome')
                ->render(function (Music $music) {
                    return Link::make($music->name)
                        ->route('platform.music.edit', $music);
                }),

            TD::make('tone', 'Tom'),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
