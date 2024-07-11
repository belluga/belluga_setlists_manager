@php
    $checked = isset($checked) ? $checked : 'true';
@endphp

<input id="{{ $name }}"
    class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
    type="checkbox" checked="{{ $checked }}" name="{{ $name }}" />
<label class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700"
    for="{{ $name }}">{{ $label }}</label>


<div class="block min-h-6 pl-7">
    <label>
        <input id="checkbox-1"
            class="w-5 h-5 ease-soft text-base -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
            type="checkbox" />
        <label for="checkbox-1" class="cursor-pointer select-none text-slate-700">Checkbox</label>
    </label>
</div>
