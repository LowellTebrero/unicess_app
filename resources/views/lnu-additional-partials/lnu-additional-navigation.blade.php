<nav class=" mt-10">
    <ul class="flex p-5 justify-center space-x-16">
        <li>
        <x-nav-link class="" :href="route('lnu-additional-partials.event-additionals')" :active="request()->routeIs('lnu-additional-partials.event-additionals')">
            {{ __('Events') }}
        </x-nav-link>
        </li>

        <li>
        <x-nav-link class="" :href="route('lnu-additional-partials.features-additionals')" :active="request()->routeIs('lnu-additional-partials.features-additionals')">
            {{ __('Articles') }}
        </x-nav-link>
        </li>




    </ul>
</nav>
