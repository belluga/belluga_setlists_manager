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
        $dashboard->route_string = 'home';

        $setlists_my = new stdClass();
        $setlists_my->label = 'Meus Repertórios';
        $setlists_my->route_string = 'setlists_my';

        $setlists_shared = new stdClass();
        $setlists_shared->label = 'Compartilhados Comigo';
        $setlists_shared->route_string = 'setlists_shared';

        $setlists = new stdClass();
        $setlists->label = 'Repertórios';
        $setlists->submenu = [
            $setlists_my, $setlists_shared
        ];

        $musics_my = new stdClass();
        $musics_my->label = 'Minhas Músicas';
        $musics_my->route_string = 'musics_my';

        $musics_shared = new stdClass();
        $musics_shared->label = 'Compartilhadas Comigo';
        $musics_shared->route_string = 'musics_shared';

        $musics = new stdClass();
        $musics->label = 'Músicas';
        $musics->submenu = [
            $musics_my, $musics_shared
        ];


        $menu = [
            $dashboard, $setlists, $musics
        ];

        return view('components.main.side_nav.side_menu', ["menu" => $menu]);
    }
}
