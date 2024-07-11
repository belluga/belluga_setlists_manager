<!DOCTYPE html>
<html>

<x-main.head />

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500 h-screen">
    <x-sidemenu />
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <header class="sticky top-[1%] z-100">
            @yield('header')
        </header>
        <div class="lg:ml-80" data-bucket="1">
            <div class="m-16px">
                <div class="w-full px-6 py-6 mx-auto">
                    @yield('main')
                    <x-footer />
                </div>
            </div>
        </div>
    </main>


</body>
<!-- plugin for charts  -->
<script src="./assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="./assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>

</html>
