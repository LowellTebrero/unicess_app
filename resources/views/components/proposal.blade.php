    <style>
        [x-cloak] { display: none }
    </style>

<div x-cloak x-data="{ open: false }" >

    <span @click="open = true" x-on:keydown.escape.window="show = false" >{{ $trigger }}</span>

    <div x-show="open" @click.outside="open = false"
    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    @click.away="open = false">

    {{ $slot }}
    </div>
</div>




