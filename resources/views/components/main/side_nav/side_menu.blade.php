<div
    class="navbar-menu z-50 fixed top-0 hidden flex lg:flex flex-col justify-between bg-coolGray-900 max-w-xs w-9/12 h-full overflow-y-auto">
    <div class="navbar-backdrop fixed lg:hidden inset-0 bg-coolGray-900 opacity-60"></div>
    <div class="relative bg-coolGray-900">
        <div class="fixed -left-4 p-8 pl-12 max-w-xs w-9/12 z-50 bg-coolGray-900">
            <a class="block max-w-max" href="#">
                <img src="flex-ui-assets/logos/dashboard/flex-ui-green.svg" alt="" data-config-id="auto-img-2-1">
            </a>
        </div>
        <div class="mt-28">
            <ul class="px-4 mb-8">

                @foreach ($menu as $item)
                    <div class="pb-6">
                        @if (isset($item->route_string))
                            <x-main.side_nav.item label="{{ $item->label }}" route="{{ $item->route_string }}" />
                        @else
                            <x-main.side_nav.item label="{{ $item->label }}" />
                        @endif

                        @if (isset($item->submenu))
                            @foreach ($item->submenu as $submenu)
                                <x-main.side_nav.sub_item label="{{ $submenu->label }}"
                                    route="{{ $submenu->route_string }}" />
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="relative bg-coolGray-900">
        <x-main.side_nav.user_card />
    </div>
</div>
