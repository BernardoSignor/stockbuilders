@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-purple-500 text-start text-base font-medium text-purple-200 bg-purple-950/40 focus:outline-none focus:text-white focus:bg-purple-950/60 focus:border-purple-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-gray-100 hover:bg-gray-800 hover:border-purple-900 focus:outline-none focus:text-gray-100 focus:bg-gray-800 focus:border-purple-900 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
