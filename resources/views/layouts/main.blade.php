<!DOCTYPE html>
<html>

<x-main.head />

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">

    <x-sidemenu />
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">

        <div class="lg:ml-80" data-bucket="1">
            <header>
                @yield('header')
            </header>

            <main
                class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
                @yield('main')
            </main>
            <x-footer />
        </div>
        </section>
        </div>
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
