@php
    $checked = isset($checked) ? $checked : 'true';
@endphp

<input id="{{ $name }}"
    class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
    type="checkbox" checked="{{ $checked }}" name="{{ $name }}" />
<label class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700"
    for="{{ $name }}">{{ $label }}</label>
