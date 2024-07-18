<?php

namespace App\View\Components;

// use App\ViewModel\Menu;

use App\Models\Music;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use stdClass;

class MusicsTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $musics = Music::paginate(3);

        return view('components.musics.main_table', ["musics" => $musics]);
    }
}
