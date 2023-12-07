<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        @vite([ 'resources/css/lnu-additional.css'])
        <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
        <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>

    <body class="font-sans antialiased">


        {{--  Nav Section  --}}
        <nav  x-data="{ open: false }" class="bg-blue-800 sticky top-0 z-20 h-[7vh] flex items-center px-10 justify-between">
                        <a class="xl:text-3xl text-lg font-semibold tracking-wider text-yellow-400"
                        href="{{ route('lnu') }}">
                        UniCESS
                        </a>

                        @auth
                            @php
                                $notifs = auth()
                                    ->user()
                                    ->unreadNotifications->count();
                                $notifications = auth()->user()->unreadNotifications;
                                $id = Auth::user()->id;
                                $user = App\Models\User::find($id);
                                $usernotification = Illuminate\Support\Facades\DB::table('notifications')->get();
                                $note = Illuminate\Support\Facades\DB::table('notifications')
                                    ->where('read_at', null)
                                    ->count();
                                $notifs = auth()
                                    ->user()
                                    ->unreadNotifications->count();
                                $notifications = auth()->user()->unreadNotifications;
                                $proposals = App\Models\Proposal::all();
                            @endphp

                            <div class="flex">
                                <div class="hidden sm:flex sm:items-center sm:ml-6">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2  border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:text-yellow-500 focus:outline-none transition ease-in-out duration-150">
                                                <div>{{ Auth::user()->first_name }}</div>

                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">

                                            @if (Auth::user()->authorize == 'checked')
                                                @hasrole('admin')
                                                    <a href={{ route('admin.dashboard.index') }}
                                                        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                        Dashboard
                                                    </a>
                                                @else
                                                    <a href={{ route('User-dashboard.index') }}
                                                        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                        Dashboard
                                                    </a>
                                                @endhasrole

                                                <a href={{ route('profile.partials.edit-auth-profile', $user->id) }}
                                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    Profile
                                                </a>
                                            @else
                                                @if (Auth()->user()->first_name == null)
                                                    <h1 class="text-xs text-red-600 mt-3 mx-5 mb-5 m-auto text-left">Please fill-up your
                                                        Profile Information, In-order to get Authorize</h1>
                                                @else
                                                    <h1 class="text-xs text-red-600 mt-3 mx-5 mb-5 m-auto text-left">You are not
                                                        authorize yet, The admin is reviewing your account details</h1>
                                                @endif

                                                <a href={{ route('profile.partials.edit-auth-profile', $user->id) }}
                                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    Profile
                                                </a>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                        @endauth

                        {{--  Guest Dropdown  --}}
                        @guest
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">

                                    <button
                                        class="inline-flex items-center px-3 py-2 border-none border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:text-yellow-500 focus:outline-none transition ease-in-out duration-150">
                                        <div>Login</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>

                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('login')">
                                        {{ __('Login') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('register')">
                                        {{ __('Register') }}
                                    </x-dropdown-link>

                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endguest


                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button @click="open = ! open"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    @guest
                        <!-- Responsive Navigation Menu -->
                        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden ">
                            <!-- Responsive Settings Options -->
                            <div class="pt-4 pb-1 border-t border-gray-200">

                                <x-dropdown-link :href="route('login')" class="text-white">
                                    {{ __('Login') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('register')" class="text-white">
                                    {{ __('Register') }}
                                </x-dropdown-link>

                            </div>
                        </div>
                    @endguest

                    @auth
                        <!-- Responsive Navigation Menu -->
                        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden ">

                            <!-- Responsive Settings Options -->
                            <div class="pt-4 pb-1 border-t border-gray-200">

                                <div class="px-4 mt-2">
                                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->first_name }}</div>
                                </div>

                                <div class="space-y-1">

                                    <x-responsive-nav-link :href="route('dashboard')" class="text-white text-sm">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>

                                    <x-responsive-nav-link :href="route('profile.partials.edit-auth-profile', $user->id)" class="text-white text-sm">
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')" class="text-white text-sm"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
        </nav>


          {{--  Carousel  --}}
          <section class="w-[85%] mx-auto mt-10 rounded-lg">
            <div id="carouselExampleIndicators" class="carousel slide rounded-lg" data-bs-ride="true" >
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded-lg  overflow-hidden h-[30vh]   ">
                  <div class="carousel-item active">
                    <img src="{{ asset('img/carousel-4.png') }}" class="d-block w-full h-[60vh]" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/carousel-2.jpg') }}" class="d-block " alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/carousel-3.jpg') }}" class="d-block " alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

    <section class="bg-white sticky top-16 z-10">
        @include('lnu-additional-partials.lnu-additional-navigation')
    </section>

    <section class="my-10 p-10 ">
        @yield('content')
    </section>


    {{--  Footer  --}}
    @include('lnu-partials.lnu-footer')


    <x-messages/>


     {{--  <script src="{{ asset('js/preloader.js') }}"></script>  --}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
     {{--  <script>
        $( ".a" ).addEventListener("click", function(event){
            event.preventDefault()
        });
     </script>  --}}
</body>
</html>
