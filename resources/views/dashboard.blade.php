<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6 px-4 sm:px-0">
                <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Area administrativa</p>
                            <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                Bem-vindo, {{ Auth::user()->name }}!
                            </h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                Aqui voce acompanha os principais dados do estoque e acessa as funcoes mais usadas do sistema.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('products.create') }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                Novo produto
                            </a>

                            <a href="{{ route('categories.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white">
                                Nova categoria
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-lg bg-white p-5 shadow-sm dark:bg-gray-800">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de produtos</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalProducts }}</p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm dark:bg-gray-800">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Categorias</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCategories }}</p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm dark:bg-gray-800">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Estoque baixo</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $lowStockProducts }}</p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm dark:bg-gray-800">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Valor em estoque</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                            R$ {{ number_format($totalStockValue, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-[1fr_280px]">
                    <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ultimos produtos cadastrados</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Consulta rapida dos itens mais recentes.</p>
                            </div>

                            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                Ver todos
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse text-left text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                        <th class="py-3 pr-4 font-semibold">Produto</th>
                                        <th class="py-3 pr-4 font-semibold">Categoria</th>
                                        <th class="py-3 pr-4 font-semibold">Quantidade</th>
                                        <th class="py-3 font-semibold">Preco</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse ($latestProducts as $product)
                                        <tr>
                                            <td class="py-3 pr-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                            <td class="py-3 pr-4 text-gray-600 dark:text-gray-300">{{ $product->category->name }}</td>
                                            <td class="py-3 pr-4">
                                                @if ($product->quantity <= 10)
                                                    <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">
                                                        {{ $product->quantity }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-700 dark:text-gray-300">{{ $product->quantity }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 text-gray-700 dark:text-gray-300">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-6 text-center text-gray-500 dark:text-gray-400">
                                                Nenhum produto cadastrado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Acessos rapidos</h3>
                        <div class="mt-4 grid gap-3">
                            <a href="{{ route('products.index') }}" class="rounded-md border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700">
                                Gerenciar produtos
                            </a>

                            <a href="{{ route('categories.index') }}" class="rounded-md border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700">
                                Gerenciar categorias
                            </a>

                            <a href="{{ route('products.report') }}" class="rounded-md border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700">
                                Relatorio de produtos
                            </a>

                            <a href="{{ route('products.report.pdf') }}" class="rounded-md border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700">
                                Gerar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
