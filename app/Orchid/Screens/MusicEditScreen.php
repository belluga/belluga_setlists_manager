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
    public function query(Music $music): iterable
    {
        return [
            'music' => $music
        ];
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
            Layout::modal(
                'artistAddModal',
                Layout::rows([
                    Input::make('name')
                        ->title('Nome')
                        ->placeholder('Bob Marley'),
                    Quill::make('bio')
                        ->title('Sobre o artista')
                        ->toolbar(['text', 'format', 'media'])
                        ->placeholder('Conte um pouco da história do artista'),
                ]),
            )
                ->title('Adicionar artista')
                ->applyButton('Adicionar')
                ->closeButton('Cancelar'),

            Layout::modal(
                'genreAddModal',
                Layout::rows([
                    Input::make('name')
                        ->title('Nome')
                        ->placeholder('Rock\'n\'Roll'),
                    Relation::make('parent')
                        ->title('Gênero Pai')
                        ->fromModel(Genre::class, 'name'),
                ]),
            )
                ->title('Adicionar gênero')
                ->applyButton('Adicionar')
                ->closeButton('Cancelar'),

            Layout::split(
                [
                    Layout::rows(
                        [
                            Input::make('name')
                                ->title('Nome')
                                ->value($this->music?->name)
                                ->placeholder('Hey Jude')->required(),

                            RadioButtons::make('tone')
                                ->title('Tom')
                                ->value($this->music?->tone)
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
                                ->value($this->music?->lyrics)
                                ->title('Letra + Cifra')->required(),
                        ]
                    ),
                    Layout::rows(
                        [

                            Relation::make('genres.')
                                ->title('Gêneros')
                                ->multiple()
                                ->searchColumns('name')
                                ->value($this->music?->genres)
                                ->fromModel(Genre::class, 'name'),

                            ModalToggle::make('Adicionar Gênero')
                                ->modal('genreAddModal')
                                ->method('addGenre')
                                ->icon('plus'),

                            Relation::make('composer.')
                                ->title('Compositores')
                                ->multiple()
                                ->searchColumns('name')
                                ->value($this->music?->composer)
                                ->fromModel(Artist::class, 'name'),

                            Relation::make('interpreter.')
                                ->title('Intérpretes')
                                ->multiple()
                                ->searchColumns('name')
                                ->value($this->music?->interpreter)
                                ->fromModel(Artist::class, 'name'),

                            ModalToggle::make('Adicionar Artista')
                                ->modal('artistAddModal')
                                ->method('addArtist')
                                ->icon('plus'),
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
        if ($this->music?->id == true) {
            $this->music->fill($request->get('music'))->save();
        } else {
            $this->_create($request);
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



        $this->music = Music::create(
            ['owner' => Auth::id(), ...$validated_data]
        );

        $_genres = is_array($request->genres) ? $request->genres : $request->genres;

        if ($_genres != null) {
            // dd([
            //     '$_genres' => $_genres,
            //     '$this->music' => $this->music,
            //     '$this->music->genres' => $this->music->genres(),
            //     'find' => Music::find($this->music->id),
            // ]);
            $this->music->genres()->sync($_genres);
        }


        // if (is_array($request->composer)) {
        //     foreach ($request->composer as $composer) {
        //         $artist = Artist::find($composer);
        //         if ($artist != null) {
        //             $this->music->composer->attach($artist);
        //         }
        //     }
        // }

        // if (is_array($request->interpreter)) {
        //     foreach ($request->interpreter as $interpreter) {
        //         dd($interpreter);
        //         $music->interpreter->attach($interpreter);
        //     }
        // }
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

    /**
     * @param Illuminate\Http\Request
     * 
     * @return void
     */
    public function addArtist(Request $request)
    {

        $request_valdated = $request->validate(
            [
                'name' => ["required", 'min:2', 'max:255']
            ]
        );

        Artist::create(['creator_id' => Auth::id(), ...$request_valdated]);
    }

    public function addGenre(Request $request)
    {

        $request_valdated = $request->validate(
            [
                'name' => ["required", 'min:2', 'max:255']
            ]
        );

        Genre::create(['creator_id' => Auth::id(), ...$request_valdated]);
    }

    public function delete(Music $music)
    {
        $music->delete();
    }
}
