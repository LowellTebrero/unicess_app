@guest

    <!-- Navigation Links -->
    <div class="">
        <x-nav-link class="" :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>

    </div>
    <div class="">
        <x-nav-link class="" :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Sign-up') }}
        </x-nav-link>

    </div>

@endguest
