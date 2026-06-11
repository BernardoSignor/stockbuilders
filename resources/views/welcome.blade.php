@extends('layouts.site')

@section('content')
    <section class="space-y-6">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_320px]">
            <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                <p class="text-sm font-medium text-purple-300">Area publica</p>
                <div class="mt-2 flex items-center gap-3">
                    <x-application-logo class="h-11 w-11 text-purple-300" />
                    <h1 class="text-3xl font-bold text-white">StockBuilderS</h1>
                </div>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-300">
                    Consulta de produtos disponiveis no estoque, com categoria, quantidade e preco atual.
                </p>

                <div class="mt-5 flex flex-wrap gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-md bg-purple-700 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-600">
                            Acessar dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-purple-700 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-600">
                            Entrar no sistema
                        </a>
                    @endauth
                </div>
            </div>

            <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-white">Resumo</h2>

                <div class="mt-4 divide-y divide-gray-800">
                    <div class="py-3">
                        <p class="text-sm text-gray-400">Produtos disponiveis</p>
                        <p class="mt-1 text-2xl font-bold text-white">{{ $availableProducts }}</p>
                    </div>

                    <div class="py-3">
                        <p class="text-sm text-gray-400">Categorias cadastradas</p>
                        <p class="mt-1 text-2xl font-bold text-white">{{ $categories->count() }}</p>
                    </div>

                    <div class="py-3">
                        <p class="text-sm text-gray-400">Produtos com estoque baixo</p>
                        <p class="mt-1 text-2xl font-bold text-white">{{ $lowStockProducts }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">Produtos disponiveis</h2>
                    <p class="text-sm text-gray-300">Lista publica para consulta rapida.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('home') }}" class="grid gap-3 sm:grid-cols-[1fr_220px_auto]">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar produto"
                    class="rounded-md border-gray-700 bg-gray-950 text-gray-100 focus:border-purple-500 focus:ring-purple-500"
                >

                <select name="category_id" class="rounded-md border-gray-700 bg-gray-950 text-gray-100 focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Todas categorias</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="rounded-md bg-purple-700 px-4 py-2 font-semibold text-white hover:bg-purple-600">
                    Filtrar
                </button>
            </form>

            <div class="mt-5 overflow-x-auto rounded-md border border-gray-800">
                <table class="w-full border-collapse text-left text-sm">
                    <thead class="bg-gray-950">
                        <tr>
                            <th class="border-b border-gray-800 px-4 py-3 text-gray-200">Produto</th>
                            <th class="border-b border-gray-800 px-4 py-3 text-gray-200">Categoria</th>
                            <th class="border-b border-gray-800 px-4 py-3 text-gray-200">Estoque</th>
                            <th class="border-b border-gray-800 px-4 py-3 text-gray-200">Preco</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-800/60">
                                <td class="px-4 py-3 font-medium text-white">{{ $product->name }}</td>
                                <td class="px-4 py-3 text-gray-300">{{ $product->category->name }}</td>
                                <td class="px-4 py-3 text-gray-300">{{ $product->quantity }}</td>
                                <td class="px-4 py-3 text-gray-300">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">Nenhum produto encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
