<section data-section-id="2" data-share="" data-category="dashboard-page-headings" data-component-id="f2106989_01_awz"
    class="bg-white p-8">
    <div class="flex flex-wrap items-center -m-2">
        <div class="w-full md:w-1/2 p-2">
            <h2 class="mb-2 font-semibold text-black text-3xl" data-config-id="auto-txt-1-1">{{ $title }}</h2>
            @isset($description)
                <p class="text-coolGray-500 font-medium" data-config-id="auto-txt-2-1">{{ $description }}</p>
            @endisset
        </div>
        <div class="w-full md:w-1/2 p-2">
            <div class="flex flex-wrap justify-end -m-2">
                <div class="w-full md:w-auto p-2">
                    @if (isset($buttonRoute))
                        <x-main.add_button label="{{ $buttonLabel }}" route="{{ $buttonRoute }}" />
                    @else
                        <x-main.add_button label="{{ $buttonLabel }}" />
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
