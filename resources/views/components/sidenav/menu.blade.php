@php
    $route = Route::current();
    $routeName = $route->getName();
@endphp

{{-- <div class=""> --}}
<div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
    <ul class="flex flex-col pl-0 mb-0">
        @foreach ($menu as $item)
            <div class="pb-6">
                @php
                    $active = '0';
                    if ($routeName == $item->route_string) {
                        $active = '1';
                    }
                @endphp
                <x-sidenav.menu_item label="{{ $item->label }}" route="{{ $item->route_string }}"
                    icon="{{ $item->icon }}" active="{{ $active }}" />
            </div>
        @endforeach
    </ul>
</div>
