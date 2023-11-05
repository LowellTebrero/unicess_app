@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' border-b-2 border-blue-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
