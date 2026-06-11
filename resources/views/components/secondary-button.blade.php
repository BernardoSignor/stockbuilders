<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center rounded-md border border-purple-900/50 bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-200 shadow-sm transition duration-150 ease-in-out hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-950 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
