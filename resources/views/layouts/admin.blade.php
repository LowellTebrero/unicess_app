<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', config('app.name', 'UniCESS'))</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ToastrAPI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Fonts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/sidebar.css'])
    @vite(['resources/css/checkbox.css'])
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">

</head>

<body class="font-sans antialiased overflow-hidden">



    <section class="flex w-full relative h-[100vh]  overflow-hidden">

        <!-- Sidebar Section  -->
        <div class="sidebar xl:w-[12rem] 2xl:w-[14rem] sticky top-0 left-0 transition-all h-full ">
            @include('layouts._admin_sidebar')
        </div>

        <div class="flex-col flex w-full flex-1 relative">
            <!-- Navbar Section  -->
            <div class="w-full flex sticky top-0 z-40">
                <div class="bg-blue-800 flex items-center justify-center xl:hidden">
                    <button class="ml-4 btn-slide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h18M3 18h18"/></svg>
                    </button>
                </div>
                <div class="w-full">
                     @include('layouts.navbar-dashboard')
                </div>

            </div>

             <!-- Hero Section  -->
            <main id="hero-section" class="p-5 bg-blue-100 h-full w-full transition-all">
                {{ $slot }}
            </main>
        </div>

    </section>

    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
     <script src="{{ asset('js/proofOfFile.js') }}"></script>

    @yield('scripts')
    @stack('scripts')

    @livewireScripts
    <livewire:pending-user>
        <livewire:pending-proposal>
            <livewire:ongoing-proposal>
                <livewire:finished-proposal>
                    {{--  <livewire:admin-notification>  --}}
</body>

</html>
