@php
    $type = isset($type) ? $type : 'text';
@endphp

<div>
    <label class="mb-2
    ml-1 font-bold text-xs text-slate-700">{{ $label }}</label>
    <div class="mb-4">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}"
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="{{ $placeholder }}" aria-label="{{ $label }}" />
    </div>
    @error($name)
        <p><span class="text-xs !text-red">{{ $message }}</span></p>
    @enderror
</div>
