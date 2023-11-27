<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UniCESS') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/preloader.css'])
    @vite(['resources/css/sidebar.css'])

    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased">

    <section class="flex w-full md:flex-row xl:flex-row relative min-h-[100vh]">

        @if (Auth::user()->authorize == 'checked')


            {{--  Sidebar Section  --}}
            <div class="sidebar xl:w-[12rem] 2xl:w-[14rem] 2xl:sticky xl:top-0 xl:left-0 transition-all">
                @include('layouts._user_sidebar')
            </div>


        <div class="flex-col flex w-full flex-1 relative">
            {{--  Navbar Section  --}}
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

            {{--  Hero Section  --}}
            <main id="hero-section" class="bg-blue-100 h-full w-full transition-all overflow-hidden">
                {{ $slot }}
            </main>
        </div>

        @elseif(Auth::user()->hasVerifiedEmail() == true)
        <div class="xl:flex-col flex w-full flex-1 relative">
            {{--  Navbar Section  --}}
            <div class="w-full sticky top-0 z-40">
                @include('layouts.navbar-dashboard')
            </div>

            {{--  Hero Section  --}}
            <main id="hero-section" class="bg-blue-100 h-full w-full transition-all overflow-hidden">
                {{ $slot }}
            </main>
        </div>
        @else
        <div class=" w-full min-h-screen flex items-center justify-center">
            <h1 class="text-7xl tex-center">You are not authorize</h1>
        </div>

        @endif

    </section>

    {{--  <script>
        let button = document.querySelector(".btn-slide")
        let sidebar = document.querySelector(".sidebar")
        let closebutton = document.querySelector(".close-button")

        button.addEventListener('click',() => {
            sidebar.classList.toggle('active');
          });

        closebutton.addEventListener('click',() => {
            sidebar.classList.remove('active');
          });
    </script>  --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @yield('scripts')
    @livewireScripts
</body>

</html>
