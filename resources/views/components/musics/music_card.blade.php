<div class="w-full md:w-1/2 xl:w-1/4 p-3">
    <a href="{{ route('music.show', $music) }}">
        <div class="bg-white border border-coolGray-100 shadow-dashboard rounded-md">
            <div class="flex flex-col justify-center items-center px-4 pt-8 pb-6 border-b border-coolGray-100">
                <h2 class="text-sm font-medium text-coolGray-900">{{ $music->name }}</h2>
                <h3 class="mb-3 text-xs font-medium text-coolGray-400">{{ Str::words($music->raw_content, 20) }}</h3>
            </div>
            <div class="flex flex-wrap pt-4 pb-6 -m-2">
                <div class="w-full md:w-1/3 p-2">
                    <div class="text-center">
                        <p class="mb-1 text-xs text-coolGray-900 font-semibold">{{ $music->tone }}</p>
                        <p class="text-xs text-coolGray-400 font-medium">Tom</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
