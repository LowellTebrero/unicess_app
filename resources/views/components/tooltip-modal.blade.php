<div x-cloak x-data="{dropdownMenu: false}">
    <!-- Dropdown toggle button -->
    <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2   rounded-md absolute top-0 right-0">
         <svg class="absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
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


