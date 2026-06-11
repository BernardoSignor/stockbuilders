<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-md border border-transparent bg-purple-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-purple-600 focus:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-950 active:bg-purple-800']) }}>
    {{ $slot }}
</button>
