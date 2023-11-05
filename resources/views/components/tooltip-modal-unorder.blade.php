<div x-cloak x-data="{dropdownMenu: false}">
    <!-- Dropdown toggle button -->
    <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md absolute top-0 right-0">
    <svg class="fill-blue-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 16 16">
    <path fill-rule="evenodd"
    d="M2 3H1v1h1V3zm0 3H1v1h1V6zM1 9h1v1H1V9zm1 3H1v1h1v-1zm2-9h11v1H4V3zm11 3H4v1h11V6zM4 9h11v1H4V9zm11 3H4v1h11v-1z" clip-rule="evenodd" />
    </svg>
    </button>
    <!-- Dropdown list -->
    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

    {{ $slot }}
    </div>

</div>


