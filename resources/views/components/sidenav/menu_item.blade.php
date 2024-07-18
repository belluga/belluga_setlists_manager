@php
    $classes_active_a = '';
    $color = '#000000';
    $icon = isset($icon) ? $icon : 'mdi-cursor-default-outline';
    $active = isset($active) ? $active : '0';
@endphp

@if (isset($active))
    @php
        if ((int) $active == 1) {
            $classes_active_a = 'shadow-soft-xl rounded-lg bg-white font-semibold text-slate-700';
            $color = '#FFFFFF';
        }
    @endphp
@endif

<li class="mt-0.5 w-full">
    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $classes_active_a }}"
        href="@if (isset($route)) {{ route($route) }} @endif">
        <x-common.icon_square active="{{ $active }}" icon="{{ $icon }}" />
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ $label }}</span>
    </a>
</li>
