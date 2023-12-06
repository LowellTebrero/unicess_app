@auth
    @php
        $id = Auth::user()->id;
        $user = App\Models\User::find($id);
    @endphp
@endauth

<nav x-data="{ open: false }" class="bg-blue-800 border-b border-blue-900 z-40 sticky top-0">

    <!-- Primary Navigation Menu -->
    <div class="2xl:max-w-[95%] xl:w-full m-auto px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex space-x-2 2xl:space-x-12 xl:space-x-5 sm:space-x-2">
                <!-- Logo -->
                <div class="shrink-0 flex items-center ">
                    <a class="xl:text-3xl text-lg font-semibold tracking-wider text-yellow-400"
                        href="{{ route('lnu') }}">
                        UniCESS
                    </a>
                </div>
            </div>

            <div class="flex space-x-5 2xl:space-x-10 ">

                <!-- Navigation Links -->
                <div class="hidden sm:-my-px  sm:flex">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base"
                        href="#hero-section">{{ __('Home') }}</x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:flex ">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#events-section">
                        {{ __('Events') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:flex ">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#about-section">
                        {{ __('About') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:flex ">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#article-section">
                        {{ __('Articles') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:flex ">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base"
                        href="#program-and-services-section">
                        {{ __('Program') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:flex ">
                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#contact-section">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Authenticated Dropdown -->
            @auth
                @php
                    $notifs = auth()
                        ->user()
                        ->unreadNotifications->count();
                    $notifications = auth()->user()->unreadNotifications;
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

                <div class="flex-wrap px-4">
                    <x-nav-link class=" text-white text-xs xl:text-sm 2xl:text-base " href="#hero-section">
                        {{ __('Home') }}
                    </x-nav-link>


                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#events-section">
                        {{ __('Events') }}
                    </x-nav-link>

                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#about-section">
                        {{ __('About') }}
                    </x-nav-link>

                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#article-section">
                        {{ __('Articles') }}
                    </x-nav-link>

                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#program-and-services-section">
                        {{ __('Program and Services') }}
                    </x-nav-link>

                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#contact-section">
                        {{ __('Contact us') }}
                    </x-nav-link>

                </div>

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

                <div class="flex-wrap px-4">
                    <x-nav-link class=" text-white text-xs xl:text-sm 2xl:text-base " href="#hero-section">
                        {{ __('Home') }}
                    </x-nav-link>


                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#events-section">
                        {{ __('Events') }}
                    </x-nav-link>

                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#about-section">
                        {{ __('About') }}
                    </x-nav-link>



                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#article-section">
                        {{ __('Articles') }}
                    </x-nav-link>



                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#program-and-services-section">
                        {{ __('Program and Services') }}
                    </x-nav-link>



                    <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#contact-section">
                        {{ __('Contact us') }}
                    </x-nav-link>

                </div>


                <div class="px-4 mt-2">
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->name }}</div>
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
