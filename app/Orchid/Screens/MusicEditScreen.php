<?php

namespace App\Orchid\Screens;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Music;
use App\Orchid\Screens\Fields\RelationWithModal;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
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
                ->method('removeCurrentMusic')
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
                            RelationWithModal::make('genres.')
                                ->title('Gêneros')
                                ->multiple()
                                ->modalTarget('genreAddModal')
                                ->modalMethod('addGenre')
                                ->toggleIcon('plus')
                                ->toggleLabel(__('Gênero'))
                                ->searchColumns('name')
                                ->value($this->music?->genres)
                                ->fromModel(Genre::class, 'name'),

                            RelationWithModal::make('composers.')
                                ->title('Compositores')
                                ->multiple()
                                ->modalTarget('artistAddModal')
                                ->modalMethod('addArtist')
                                ->toggleIcon('plus')
                                ->toggleLabel(__("Artista"))
                                ->searchColumns('name')
                                ->value($this->music?->composers)
                                ->fromModel(Artist::class, 'name'),

                            RelationWithModal::make('interpreters.')
                                ->title('Intérpretes')
                                ->multiple()
                                ->modalTarget('artistAddModal')
                                ->modalMethod('addArtist')
                                ->toggleIcon('plus')
                                ->toggleLabel(__("Artista"))
                                ->searchColumns('name')
                                ->value($this->music?->interpreters)
                                ->fromModel(Artist::class, 'name'),
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

        $this->_attachGenders($request->genres);
        $this->_attachComposers($request->composers);
        $this->_attachInterpreters($request->interpreters);
    }

    private function _attachGenders($list)
    {
        $this->_attach('genres', $list);
    }

    private function _attachComposers($list)
    {
        $this->_attach('composers', $list,  ['type' => 'composer']);
    }

    private function _attachInterpreters($list)
    {
        $this->_attach('interpreters', $list, ['type' => 'interpreter']);
    }

    private function _attach($type, $list, $pivotValues = null)
    {
        if ($list == null) {
            return;
        }

        if ($pivotValues != null) {
            $list_with_attributes = [];
            foreach ($list as $item_id) {
                $list_with_attributes[$item_id] = $pivotValues;
            }

            $list = $list_with_attributes;
        }

        $this->music->$type()->sync($list);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCurrentMusic()
    {
        $this->delete($this->music);
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
        Alert::info('Música removida com sucesso.');
        $music->delete();
    }
}
