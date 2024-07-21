<?php

namespace App\Orchid\Screens;

use App\Models\Music;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\TD;

class MusicScreen extends Screen
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
        return 'Músicas';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Aqui você encontra todas as músicas cadastradas por você e por nossa equipe.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Adicionar Música')
                ->modal('musicModal')
                ->method('create')
                ->icon('plus'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::modal('musicModal', Layout::rows([
                Input::make('name')
                    ->title('Nome')
                    ->placeholder('Nome da música'),
                Input::make('tone')
                    ->title('Tom')
                    ->placeholder('Nome da música'),
                Input::make('lyrics')
                    ->title('Letra + Cifra')
                    ->placeholder('Nome da música')
            ]))
                ->title('Adicionar música')
                ->applyButton('Adicionar música'),

            Layout::table('musics', [
                TD::make('name'),
                TD::make('tone'),
                TD::make('Actions')
                    ->alignRight()
                    ->render(function (Music $music) {
                        return Button::make('Apagar')
                            ->confirm('Tem certeza? Depois de apagar não será possível recuperar sua música.')
                            ->method('delete', ['music' => $music->id]);
                    }),
            ]),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * 
     * @return void
     */
    public function create(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => ["required", "min:2", "max:255"],
                "tone" => ["required", Rule::in(["A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#"])],
                "lyrics" => ["required", "min:10"],
            ]
        );

        Music::create(
            ['owner' => Auth::id(), ...$validated_data]
        );
    }

    /**
     * @param Music $task
     *
     * @return void
     */
    public function delete(Music $music)
    {
        $music->delete();
    }
}
