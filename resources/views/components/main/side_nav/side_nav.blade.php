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
                <li>
                    <div>
                        <a class="p-3 py-1 flex items-center justify-between text-coolGray-600 hover:text-green-500 hover:bg-coolGray-800 rounded-md"
                            @isset($route) href="#" @endisset>
                            <div class="flex items-center">
                                {{ $slot }}
                                <p class="text-white font-medium text-base" data-config-id="auto-txt-6-1">
                                    Label</p>
                            </div>
                            <svg width="12" height="8" viewbox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"
                                data-config-id="auto-svg-3-1">
                                <path
                                    d="M11 1.17C10.8126 0.983753 10.5592 0.879211 10.295 0.879211C10.0308 0.879211 9.77737 0.983753 9.59001 1.17L6.00001 4.71L2.46001 1.17C2.27265 0.983753 2.0192 0.879211 1.75501 0.879211C1.49082 0.879211 1.23737 0.983753 1.05001 1.17C0.956281 1.26297 0.881887 1.37357 0.831118 1.49543C0.780349 1.61729 0.754211 1.74799 0.754211 1.88C0.754211 2.01202 0.780349 2.14272 0.831118 2.26458C0.881887 2.38644 0.956281 2.49704 1.05001 2.59L5.29001 6.83C5.38297 6.92373 5.49357 6.99813 5.61543 7.04889C5.73729 7.09966 5.868 7.1258 6.00001 7.1258C6.13202 7.1258 6.26273 7.09966 6.38459 7.04889C6.50645 6.99813 6.61705 6.92373 6.71001 6.83L11 2.59C11.0937 2.49704 11.1681 2.38644 11.2189 2.26458C11.2697 2.14272 11.2958 2.01202 11.2958 1.88C11.2958 1.74799 11.2697 1.61729 11.2189 1.49543C11.1681 1.37357 11.0937 1.26297 11 1.17Z"
                                    fill="#8896AB"></path>
                            </svg>
                        </a>
               
                    </div>
                </li>
                <li>
                    <a class="p-1 pl-11 flex items-center justify-between" href="#">
                        <div class="flex items-center">
                            <p class="text-coolGray-500 font-medium text-base" data-config-id="auto-txt-4-1">
                                Label</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="p-1 pl-11 flex items-center justify-between" href="#">
                        <div class="flex items-center">
                            <p class="text-coolGray-500 font-medium text-base" data-config-id="auto-txt-4-1">
                                Label</p>
                        </div>
                    </a>
                </li>
               
            </ul>
        </div>
    </div>
    <div class="relative bg-coolGray-900">
        <x-main.side_nav.user_card />
    </div>
</div>
