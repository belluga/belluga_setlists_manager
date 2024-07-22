<?php

namespace App\Orchid\Screens\Setlist;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Music;
use App\Models\Setlist;
use App\Orchid\Screens\Fields\RelationWithModal;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SetlistEditScreen extends Screen
{
    /**
     * @var Setlist
     */
    public $setlist;

    /**
     * @return bool
     */
    public function _exists()
    {
        return $this->setlist?->exists === true;
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Setlist $setlist): iterable
    {
        return [
            'setlist' => $setlist
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->setlist?->exists == true ? $this->setlist->name : __('Adicionar novo repertório');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Adicionar repertório'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->_exists()),

            Button::make('Salvar')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee($this->_exists()),

            Button::make('Deletar')
                ->icon('trash')
                ->method('removeCurrent')
                ->canSee($this->_exists()),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        
        $prepared_data = [];
        if($this->setlist?->musics != null){
            foreach($this->setlist?->musics as $music){
                $prepared_data[] = ['music' => $music->id];
            }
        }

        return [
            Layout::split(
                [
                    Layout::rows(
                        [
                            Input::make('name')
                                ->title('Nome')
                                ->value($this->setlist?->name)
                                ->placeholder('Hey Jude')->required(),

                            Quill::make('description')
                                ->title('Descrição')
                                ->value($this->setlist?->description),
                        ]
                    ),

                    Layout::rows(
                        [
                            Matrix::make('musics')
                                ->title("Músicas")
                                ->value($prepared_data)
                                ->columns([
                                    'music'
                                ])
                                ->fields([
                                    'music' => Relation::make('musics')
                                        ->fromModel(Music::class, 'name'),
                                ]),
                        ]
                    ),
                ]
            )->ratio('50/50'),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        if ($this->setlist?->id == true) {
            $this->_update($request);
        } else {
            $this->_create($request);
        }

        return redirect()->route('platform.setlist.list');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    private function _create(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => ["required", "min:2", "max:255"],
            ]
        );

        $this->setlist = Setlist::create(
            ['owner' => Auth::id(), ...$validated_data]
        );

        $this->_attachMusics($request?->musics ?? []);

        Alert::info('Repertório adicionado com sucesso.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    private function _update(Request $request)
    {
        $validated_data = $request->validate(
            [
                "name" => ["required", "min:2", "max:255"],
            ]
        );

        $this->setlist->update($validated_data);
        $this->setlist->save();

        $this->_attachMusics($request?->musics ?? []);

        Alert::info('Música alterada com sucesso.');
    }

    private function _attachMusics(array $list = [])
    {
        if ($list == null) {
            $list = [];
        }

        $musics_to_sync = [];
        foreach ($list as $table_item) {
            $musics_to_sync[] = $table_item['music'];
        }

        $this->_attach('musics', $musics_to_sync);
    }

    private function _attach($type, array $list, $pivotValues = null)
    {

        if ($pivotValues != null) {
            $list_with_attributes = [];
            foreach ($list as $item_id) {
                $list_with_attributes[$item_id] = $pivotValues;
            }

            $list = $list_with_attributes;
        }

        $this->setlist->$type()->sync($list);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCurrent()
    {
        $this->delete($this->setlist);
        return redirect()->route('platform.setlist.list');
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

    public function delete(Setlist $setlist)
    {
        Alert::info('Música removida com sucesso.');
        $setlist->delete();
    }
}
