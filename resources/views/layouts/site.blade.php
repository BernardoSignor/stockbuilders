<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StockBuilderS</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-100 text-gray-900">
        <header class="border-b border-gray-200 bg-white">
            <nav class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-950">StockBuilderS</a>

                <div class="flex flex-wrap gap-2 text-sm">
                    <a href="{{ route('home') }}" class="rounded border border-gray-300 px-3 py-2 hover:bg-gray-100">Inicio</a>
                    <a href="{{ route('products.index') }}" class="rounded border border-gray-300 px-3 py-2 hover:bg-gray-100">Produtos</a>
                    <a href="{{ route('categories.index') }}" class="rounded border border-gray-300 px-3 py-2 hover:bg-gray-100">Categorias</a>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-6">
            @yield('content')
        </main>
    </body>
</html>
