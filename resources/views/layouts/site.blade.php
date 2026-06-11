<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StockBuilderS</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-950 text-gray-100">
        <header class="border-b border-purple-950/60 bg-gray-900">
            <nav class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-white">
                    <x-application-logo class="h-8 w-8 text-purple-300" />
                    <span>StockBuilderS</span>
                </a>

                <div class="flex flex-wrap gap-2 text-sm">
                    <a href="{{ route('home') }}" class="rounded-md border border-purple-900/50 px-3 py-2 text-gray-200 hover:bg-gray-800">Inicio</a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-md border border-purple-900/50 px-3 py-2 text-gray-200 hover:bg-gray-800">Dashboard</a>
                        <a href="{{ route('products.index') }}" class="rounded-md bg-purple-700 px-3 py-2 font-semibold text-white hover:bg-purple-600">Produtos</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-purple-700 px-3 py-2 font-semibold text-white hover:bg-purple-600">Entrar</a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-6">
            @yield('content')
        </main>
    </body>
</html>
