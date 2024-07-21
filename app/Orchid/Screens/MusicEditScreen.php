<?php

namespace App\Orchid\Screens;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Music;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\UTM;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MusicEditScreen extends Screen
{
    /**
     * @var Music
     */
    public $music;

    /**
     * @return bool
     */
    public function _musicExists()
    {
        return $this->music?->exists === true;
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->music?->exists == true ? 'Alterar música' : 'Adicionar nova música';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Adicionar música')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->_musicExists()),

            Button::make('Alterar')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->_musicExists()),

            Button::make('Deletar')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->_musicExists()),
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
            Layout::split(
                [
                    Layout::rows(
                        [
                            Input::make('name')
                                ->title('Nome')
                                ->placeholder('Hey Jude')->required(),

                            RadioButtons::make('tone')
                                ->title('Tom')
                                ->options([
                                    'C' => 'C',
                                    'Db' => 'Db',
                                    'D' => 'D',
                                    'Eb' => 'Eb',
                                    'E' => 'E',
                                    'F' => 'F',
                                    'Gb' => 'Gb',
                                    'G' => 'G',
                                    'A' => 'A',
                                    'Bb' => 'Bb',
                                    'B' => 'B'
                                ])
                                ->required(),

                            TextArea::make('lyrics')
                                ->rows(10)
                                ->title('Letra + Cifra')->required(),
                        ]
                    ),
                    Layout::rows(
                        [

                            Relation::make('genres')
                                ->title('Gêneros')
                                ->multiple()
                                ->fromModel(Genre::class, 'name'),

                            Relation::make('composer')
                                ->title('Compositores')
                                ->multiple()
                                ->fromModel(Artist::class, 'name'),

                            Relation::make('interpreter')
                                ->title('Intérpretes')
                                ->multiple()
                                ->fromModel(Artist::class, 'name'),
                            // Relation::make('genres')
                            //     ->title('Gênero')
                            //     ->multiple()
                            //     ->searchColumns('name')
                            //     ->chunk(20)
                            //     ->fromModel(Genre::class, 'name'),

                            // Button::make('+ genre')->method('buttonClickProcessing')->type(Color::SECONDARY),

                        ]
                    ),

                ]
            )->ratio('60/40'),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        if ($this->music == null) {
            $this->_create($request);
        } else {
            $this->music->fill($request->get('music'))->save();
        }

        Alert::info('Música adicionada com sucesso.');

        return redirect()->route('platform.music.list');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return Music
     */
    private function _create(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => ["required", "min:2", "max:255"],
                "tone" => [
                    "required",
                    Rule::in(
                        [
                            'C', 'Db', 'D', 'Eb', 'E', 'F', 'Gb', 'G', 'A', 'Bb', 'B'
                        ]
                    )
                ],
                "lyrics" => ["required", "min:10"],
            ]
        );

        return Music::create(
            ['owner' => Auth::id(), ...$validated_data]
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->music->delete();

        Alert::info('Música removida com sucesso.');

        return redirect()->route('platform.music.list');
    }
}
