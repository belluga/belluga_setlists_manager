<?php

namespace App\Orchid\Layouts\Setlist;

use App\Models\Setlist;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SetlistListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'setlists';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Nome')
                ->render(function (Setlist $setlist) {
                    return Link::make($setlist->name)
                        ->route('platform.setlist.edit', ['setlist' => $setlist]);
                }),

            TD::make('description', 'Descrição'),
            TD::make('Actions')
                ->alignRight()
                ->render(function (Setlist $setlist) {
                    return Button::make('Apagar')
                        ->confirm('Tem certeza? Depois de apagar não será possível recuperar seu repertório. As músicas NÃO SERÃO APAGADAS.')
                        ->action(route('platform.setlist.edit', [
                            'method' => 'delete',
                            'music' => $setlist
                        ]));
                }),
        ];
    }
}
