@guest
    <!-- Navigation Links -->
    <div>
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>

    </div>
    <div class="">
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Sign-up') }}
        </x-nav-link>

    </div>
@endguest
