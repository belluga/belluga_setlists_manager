@unless ($breadcrumbs->isEmpty())
    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($loop->first)
                <li class="text-sm leading-normal">
                    <a class="opacity-50 text-slate-700" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>
            @else
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                    aria-current="page">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endunless
