@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm']) !!}>
