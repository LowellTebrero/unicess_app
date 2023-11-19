@auth
@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
$usernotification = Illuminate\Support\Facades\DB::table('notifications')->get();
$note = Illuminate\Support\Facades\DB::table('notifications')->where('read_at', NULL)->count();

@endphp
@endauth


@php
$notifs = auth()->user()->unreadNotifications->count();
$notifications = auth()->user()->unreadNotifications;

@endphp

<nav x-data="{ open: false }" class="bg-blue-800 border-b border-blue-900  sticky top-0 z-50">

        <!-- Primary Navigation Menu -->
        <div class="max-w-[100%] m-auto sm:px-4">
            <div class="flex justify-between h-16 ">
                <div class="flex navbar-dashboard transition-all">

                     {{--  Collapse Button  --}}
                     {{--  <div class="mt-6">
                        <div class="flex justify-center w-full">
                            <button class="btn-slide ">
                                <svg class="fill-white " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M120 816v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                            </button>
                        </div>
                    </div>  --}}

                    <!-- Navigation Links -->
                    @if (Auth()->user()->authorize == 'pending')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-nav-link class="text-white home" :href="route('lnu')" :active="request()->routeIs('lnu')">
                            {{ __('Home') }}
                        </x-nav-link>
                    </div>
                    @endif

                    @role('admin')
                     <div class="text-white mt-2 ml-6">
                        <h1 class="tracking-wider text-sm font-medium">Welcome, {{ Auth()->user()->name }} </h1>
                        <span class="tracking-wider text-[.7rem] text-slate-200">{{  date('D M d, Y') }} </span>
                    </div>
                    @endrole

                </div>

                {{--  Authenticated Dropdown  --}}
                @auth

                <div class="flex">
                    @role('admin')
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                            <div @click="open = ! open">
                                <button class="mt-4 relative ">
                                    @if ($notifs > 0)
                                    <h1 class="text-red-500 text-[.2rem] rounded-full  px-1 pt-1 font-semibold absolute z-10 right-0 top-2 bg-red-500">{{ $notifs }}</h1>
                                    @endif
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
                                    class="absolute z-50 mt-2  rounded-md origin-top-right right-0"
                                    style="display: none;"
                                    @click="open = false">

                                    <div class="rounded-md drop-shadow-lg overflow-hidden overflow-y-auto h-[50vh]">
                                        <div class="flex flex-col  w-[20rem] rounded  relative ring-1 ring-black ring-opacity-5">


                                        <div class="p-2 sticky top-0 bg-white z-10 flex justify-between items-center">
                                            <h1 class="font-semibold text-sm text-gray-600">Notifications</h1>
                                            <a href={{ route('markallsread') }} class="text-[.7rem] text-gray-700">Mark all as read</a>
                                        </div>

                                        @foreach (auth()->user()->notifications as $notification )
                                            <hr>

                                            @foreach($notification->data as $key => $value)

                                                <div class="overflow-hidden">

                                                    @if (($key == 'id' ) == !null )
                                                    <a href={{ route('admin.dashboard.edit-proposal',  ['id' => $value, 'notification' => $notification->id ] ) }} data-id="{{ $notification->id }}" class="absolute opacity-0  h-[10vh] sm:h-[10vh] md:h-[10vh]  2xl:h-[8.5vh]  w-full">
                                                    </a>
                                                    @endif

                                                    @if (($key == 'project_title' ) == !null )
                                                        <div class="px-4 py-2 flex  {{ $notification->read_at == NULL ? 'bg-teal-50' : 'bg-white' }}">
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
                                                </div>

                                                <div>

                                                    @if (($key == 'user_id' ) == !null )
                                                    <a href={{ route('admin.users.show',  ['user' => $value, 'user_id' => $notification->id ] ) }} data-id="{{ $notification->id }}" class="absolute opacity-0  h-[10vh] sm:h-[10vh] md:h-[10vh]  2xl:h-[8.5vh]  w-full">

                                                    </a>
                                                    @endif

                                                    @if (($key == 'email' ) == !null )
                                                        <div class="px-4 py-2 flex hover:bg-teal-100 {{ $notification->read_at == NULL ? 'bg-teal-50' : 'bg-white' }}">
                                                            <div class="mr-2">
                                                                  <svg class="fill-teal-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><path d="M256 256c52.805 0 96-43.201 96-96s-43.195-96-96-96-96 43.201-96 96 43.195 96 96 96zm0 48c-63.598 0-192 32.402-192 96v48h384v-48c0-63.598-128.402-96-192-96z" /></svg>
                                                            </div>
                                                            <div>
                                                                <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">New Account registered:</span>
                                                                <h1 class="text-[.7rem] text-gray-700"> {{Str::limit($value, 80) }}</h1>
                                                                <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            @endforeach
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole

                    @hasrole(['New User', 'Extension coordinator' , 'Faculty extensionist'])

                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                            <button class="mt-4 relative ">
                                @if ($notifs > 0)
                                <h1 class="text-red-500 text-[.2rem] rounded-full  px-1 pt-1 font-semibold absolute z-10 right-0 top-2 bg-red-500">{{ $notifs }}</h1>
                                @endif

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
                            class="absolute z-50 mt-2  origin-top-right right-0"
                            style="display: none;"
                            @click="open = false">

                                <div class="rounded-md drop-shadow-lg overflow-hidden overflow-y-auto h-[50vh]">
                                    <div class="flex flex-col  w-[20rem] rounded  relative ring-1 ring-black ring-opacity-5">

                                        <div class="p-2 sticky top-0 bg-white z-10 flex justify-between items-center">
                                            <h1 class="font-semibold text-sm text-gray-600">Notifications</h1>
                                            <a href={{ route('markallsread') }} class="text-[.7rem] text-gray-700">Mark all as read</a>
                                        </div>

                                        {{--  {{ dd($notifications) }}  --}}
                                        @forelse (auth()->user()->notifications as $notification)

                                        <hr>

                                        @foreach($notification->data as $key => $value)
                                            <div class="hover:bg-gray-200">

                                                @if (($key == 'authorize') == !null )
                                                    <div class="pb-3 px-4 flex  {{ $notification->read_at == NULL ? 'bg-teal-50' : 'bg-white' }}">
                                                        <div class="mt-2 mr-2">
                                                            <svg class="fill-teal-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path  d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                        </div>
                                                        <div>
                                                            @if ($value == 'close')
                                                                    <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">Account Update:</span>
                                                                    <h1 class="text-[.7rem] text-gray-700">Your Account has been declined by admin</h1>
                                                                    <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                                                                @elseif ($value == 'checked')
                                                                    <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">Account Update:</span>
                                                                    <h1 class="text-[.7rem] text-gray-700">Your Account has been approved by admin</h1>
                                                                    <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endif

                                                @if (($key == 'tag_id') == !null )
                                                <div class="pb-3 px-4 flex  {{ $notification->read_at == NULL ? 'bg-teal-50' : 'bg-white' }}">
                                                    <div class="mt-2 mr-2">
                                                        <svg class="fill-teal-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path  d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    </div>
                                                    <div>
                                                        <span class="text-[.7rem] font-semibold tracking-wider text-gray-900 inline-block">Proposal Update:</span>
                                                        <h1 class="text-[.7rem] text-gray-700">Proposal has been updated.</h1>
                                                        <span class="text-[.7rem] font-thin text-gray-400 inline-block">{{ $notification->created_at->diffForHumans() }}</span>

                                                    </div>
                                                </div>
                                            @endif

                                            </div>
                                        @endforeach

                                        {{--  <a class="text-blue-500  text-[.7rem] py-2 " href={{ route('markasread', $notification->id) }} data-id="{{ $notification->id }}">
                                                Mark as read
                                            </a>  --}}

                                        @empty
                                        <h1 class="text-center">No notifications</h1>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endhasrole

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
                            {{--  <x-dropdown-link :href="route('admin.index')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>  --}}

                            @else
                            {{--  <x-dropdown-link :href="route('ProjectProposal.index')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>  --}}
                            @endhasrole


                            <x-dropdown-link :href="route('profile.partials.edit-auth-profile',$user->id)" class="dynamic-link">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @else

                            <h1 class="text-sm text-red-600 mt-3 mx-5 mb-5 m-auto text-left">You are not authorize yet, The admin is reviewing your account details</h1>



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
            <div class="px-4">
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->name }}</div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('dashboard')" class="text-white" class="dynamic-link">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.partials.edit-auth-profile', $user->id)" class="text-white" class="dynamic-link">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-white"
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
