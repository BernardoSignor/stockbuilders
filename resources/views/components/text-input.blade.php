@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-md border-gray-700 bg-gray-950 text-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500 disabled:opacity-60']) }}>
