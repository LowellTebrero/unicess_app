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
                        <a class="xl:text-3xl text-lg font-bold tracking-wider text-yellow-400" href="{{ route('lnu') }}">
                        UniCESS
                        </a>
                    </div>

                    <div class="flex space-x-2 ">

                    <!-- Navigation Links -->

                    <div class="hidden sm:-my-px  sm:flex">
                        <x-nav-link class=" text-white text-xs xl:text-sm 2xl:text-base" href="#hero-section">
                            {{ __('Home') }}
                        </x-nav-link>
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
                        <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#program-and-services-section">
                            {{ __('Program') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden sm:-my-px sm:flex ">
                        <x-nav-link class="text-white text-xs xl:text-sm 2xl:text-base" href="#contact-section">
                            {{ __('Contact') }}
                        </x-nav-link>
                    </div>

                </div>
                </div>

                {{--  Authenticated Dropdown  --}}
                <!-- Settings Dropdown -->

                @auth

                @php
                $notifs = auth()->user()->unreadNotifications->count();
                $notifications = auth()->user()->unreadNotifications;
                @endphp

                <div class="flex">

                    @role('admin')

                    {{--  <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                            <button class="mt-4 relative ">
                                <h1 class="text-red-500 text-[.2rem] rounded-full  px-1 pt-1 font-semibold absolute z-10 right-0 top-2 bg-red-500">{{ $notifs }}</h1>
                                <svg class="mt-1 fill-white hover:fill-slate-200" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path  d="M20 17h2v2H2v-2h2v-7a8 8 0 1 1 16 0v7ZM9 21h6v2H9v-2Z"/></svg>
                            </button>
                        </div>

                        <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-2  rounded-md shadow-lg origin-top-right right-0"
                                style="display: none;"
                                @click="open = false">
                            <div class="rounded-md ring-1 ring-black ring-opacity-5 overflow-hidden overflow-y-auto h-[50vh]">
                                <div class="flex flex-col drop-shadow-lg w-[20rem] rounded  relative bg-gray-100 ">

                                    <div class="pl-2 sticky top-0 bg-gray-100">
                                        <h1 class="font-semibold  mb-3 text-sm text-gray-700">Notifications</h1>
                                    </div>




                                    @forelse (auth()->user()->notifications as $notification )

                                    <hr>

                                    @foreach($notification->data as $key => $value)


                                    <div class="px-4 hover:bg-gray-200">
                                    @if (($key == 'project_title') == !null )
                                        <div class="flex">
                                            <div class="mt-2 mr-2">
                                                <svg class="fill-teal-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36"><path  d="M31 34H13a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v22a1 1 0 0 1-1 1Zm-17-2h16V12H14Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M16 16h12v2H16z" class="clr-i-outline clr-i-outline-path-2"/><path fill="currentColor" d="M16 20h12v2H16z" class="clr-i-outline clr-i-outline-path-3"/><path fill="currentColor" d="M16 24h12v2H16z" class="clr-i-outline clr-i-outline-path-4"/><path fill="currentColor" d="M6 24V4h18V3a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v22a1 1 0 0 0 1 1h1Z" class="clr-i-outline clr-i-outline-path-5"/><path fill="currentColor" d="M10 28V8h18V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v22a1 1 0 0 0 1 1h1Z" class="clr-i-outline clr-i-outline-path-6"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                                            </div>
                                            <div>
                                                <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">New Uploaded Proposal:</span>
                                                <h1 class="text-[.7rem] text-gray-700"> {{Str::limit($value, 80) }}</h1>
                                                <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if (($key == 'email') == !null )
                                        <div class="flex pb-3">
                                            <div class="mt-2 mr-2">

                                                <svg class="fill-teal-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path  d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <div>
                                                <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">New Account created:</span>
                                                <h1 class="text-[.7rem] text-gray-700"> {{Str::limit($value, 115) }}</h1>
                                                <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>

                                    @endif
                                    </div>
                                    @endforeach

                                   <a class="text-blue-500  text-[.7rem] py-2 " href={{ route('markasread', $notification->id) }} data-id="{{ $notification->id }}">
                                        Mark as read
                                    </a>

                                    @empty

                                    <h1 class="text-center">No notifications</h1>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>  --}}
                @endrole

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2  border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:text-yellow-500 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>


                        </x-slot>

                        <x-slot name="content">

                            @if (Auth::user()->authorize == 'checked')

                                @hasrole('admin')
                                <x-dropdown-link :href="route('admin.dashboard.index')" class="dynamic-link">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                @else
                                <x-dropdown-link :href="route('User-dashboard.index')" class="dynamic-link">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endhasrole


                            <x-dropdown-link :href="route('profile.partials.edit-auth-profile',$user->id)" class="dynamic-link">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @else

                            <h1 class="text-sm text-red-600 mt-3 mx-5 mb-5 m-auto text-left">You are not authorize yet, The admin is reviewing your account details</h1>
                            {{--  @endif  --}}

                            {{--  @if (Auth::user()->authorize == '0')  --}}
                            <x-dropdown-link :href="route('profile.partials.edit-auth-profile', $user->id)" class="dynamic-link">
                                {{ __('Profile') }}
                            </x-dropdown-link>

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

                                <button class="inline-flex items-center px-3 py-2 border-none border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:text-yellow-500 focus:outline-none transition ease-in-out duration-150">
                                    <div>Login</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    @guest
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden ">
            {{--  <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>  --}}

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
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden ">
            {{--  <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>  --}}

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
