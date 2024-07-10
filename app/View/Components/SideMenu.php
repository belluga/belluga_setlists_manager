<?php

namespace App\View\Components;

// use App\ViewModel\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use stdClass;

class SideMenu extends Component
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
        $dashboard = new stdClass();
        $dashboard->label = 'Dashboard';
        $dashboard->icon = 'vaadin-dashboard';
        $dashboard->route_string = 'home';

        $setlists = new stdClass();
        $setlists->label = 'Repertórios';
        $setlists->icon = 'iconsax-bol-music-playlist';
        $setlists->route_string = 'setlists';

        $musics = new stdClass();
        $musics->label = 'Músicas';
        $musics->icon = 'gmdi-lyrics-s';
        $musics->route_string = 'musics';


        $menu = [
            $dashboard, $setlists, $musics
        ];

        return view('components.sidenav.main', ["menu" => $menu]);
    }
}
