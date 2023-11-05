<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Unicess-Laravel') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Fonts -->

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">

</head>

<body class="font-sans antialiased ">

    {{--  md:flex-row xl:flex-row min-h-screen   --}}
    <section class="flex w-full relative min-h-screen">


        <div class="">
            {{--  Sidebar Section  --}}
            <div class="w-full sticky top-0 left-0 ">
                @include('layouts._admin_sidebar')
            </div>
        </div>


        <div class="flex-col flex w-full flex-1 ">
            {{--  Navbar Section  --}}
            <div class="w-full sticky top-0 z-40">
                @include('layouts.navbar-dashboard')
            </div>

            {{--  Hero Section  --}}
            <main id="hero-section" class="bg-blue-100 h-full w-full transition-all overflow-hidden">
                {{ $slot }}
            </main>

        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    {{--  <script src="{{ asset('js/sidebar.js') }}"></script>  --}}
     <script src="{{ asset('js/proofOfFile.js') }}"></script>

    @yield('scripts')
    @stack('scripts')

    @livewireScripts
    <livewire:pending-user>
        <livewire:pending-proposal>
            <livewire:ongoing-proposal>
                <livewire:finished-proposal>
</body>

</html>
