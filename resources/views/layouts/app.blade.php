<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'UniCESS'))</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ToastrAPI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />


    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>  --}}

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/preloader.css'])
    @vite(['resources/css/sidebar.css'])
    @vite(['resources/css/checkbox.css'])

    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    {{--  <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>  --}}
</head>

<body class="font-sans antialiased">

    <section class="flex w-full relative h-[100vh] overflow-x-hidden bg-blue-100">

        @if (Auth::user()->authorize == 'checked')
            <!-- Sidebar Section -->
            <div class="sidebar xl:w-[12rem] 2xl:w-[14rem] 2xl:sticky xl:top-0 xl:left-0 transition-all">
                @include('layouts._user_sidebar')
            </div>


            <div class="flex-col flex w-full flex-1 relative">
                 <!-- Navbar Section -->
                <div class="w-full flex sticky top-0 z-40">
                    <div class="bg-blue-800 flex items-center justify-center xl:hidden">
                        <button class="ml-2 sm:ml-4 btn-slide">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="#ffffff" d="M19 13H3v-2h16l-4-4l1.4-1.4l6.4 6.4l-6.4 6.4L15 17zM3 6h10v2H3zm10 10v2H3v-2z"/></svg>
                        </button>
                    </div>

                    <div class="w-full">
                        @include('layouts.navbar-dashboard')
                    </div>

                </div>

                <!--  Hero Section -->
                <main id="hero-section" class="p-3 sm:p-5 h-full w-full transition-all">
                    {{ $slot }}
                </main>
            </div>

        @elseif(Auth::user()->hasVerifiedEmail() == true)
            <div class="flex-col flex w-full flex-1 relative">
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

    {{--  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
    @livewireScripts
</body>

</html>
