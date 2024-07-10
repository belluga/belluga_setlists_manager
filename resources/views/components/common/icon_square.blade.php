@php
    $classes_active_div = '';
    $color = '';
    $icon = isset($icon) ? $icon : 'mdi-weather-partly-cloudy';
    $size = isset($size) ? $size : '8';
@endphp

@if (isset($active))
    @php
        if ((int) $active == 1) {
            $classes_active_div = 'bg-gradient-to-tl from-purple-700 to-pink-500';
            $color = '#FFFFFF';
        }
    @endphp
@endif

<div
    class="flex h-{{ $size }} w-{{ $size }} shadow-soft-2xl mr-2 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5 {{ $classes_active_div }}">
    @svg($icon, ['style' => "fill: $color"])
</div>
