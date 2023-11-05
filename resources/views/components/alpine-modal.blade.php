 {{--  Modal Starts here  --}}
 <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false">

    <!-- Trigger for Modal -->
    <button type="button" @click="showModal = true">{{ $scripts }}</button>

    <!-- Modal -->
    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal">

        <!-- Modal inner -->
        <div class="py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal"
            x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

            <!-- Title / Close-->
            <div class="flex items-center justify-between px-4 py-1">
                <h5 class="mr-3 text-black max-w-none text-xs">{{ $title }}</h5>
                <button type="button" class="z-50 cursor-pointer text-red-500 text-xl font-semibold focus:bg-gray-300 focus:rounded" @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr>

             <!-- content -->
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
