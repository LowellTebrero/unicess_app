<style>
    [x-cloak] { display: none }
</style>

<div x-cloak x-data="{ show: @entangle($attributes->wire('model')).defer}" x-on:keydown.escape.window="show = false" x-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 md:py-24 sm:px-0 z-40">
<div x-show="show" class="fixed inset-0 transform flex items-center justify-center overflow-auto">
    <div x-show="show" class="absolute inset-0 bg-black opacity-75"></div>

    {{--  Modal Inner  --}}
    <div x-show="show" class="bg-white rounded-lg overflow-hidden transform sm:w-full sm:mx-auto max-w-5xl"
         x-transition:enter="motion-safe:ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         @click.away="show = false">

           {{ $slot }}
    </div>
</div>
</div>
