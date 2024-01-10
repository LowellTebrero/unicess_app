@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-xs 2xl:text-sm  flex items-center px-2 2xl:px-4 py-2 pt-2 font-semibold text-gray-900 bg-gray-500 rounded-lg text-white'
            : 'text-xs 2xl:text-sm  flex items-center px-2 2xl:px-4 py-2 pt-2 font-semibold text-gray-900 rounded-lg text-white  transition duration-150 ease-in-out hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
