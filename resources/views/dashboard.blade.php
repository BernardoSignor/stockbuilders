<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6 px-4 sm:px-0">
                <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-300">Area administrativa</p>
                            <h1 class="mt-1 text-2xl font-bold text-white">
                                Bem-vindo, {{ Auth::user()->name }}!
                            </h1>
                            <p class="mt-2 text-sm text-gray-300">
                                Aqui voce acompanha os principais dados do estoque e acessa as funcoes mais usadas do sistema.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('products.create') }}" class="inline-flex items-center rounded-md bg-purple-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-600">
                                Novo produto
                            </a>

                            <a href="{{ route('categories.create') }}" class="inline-flex items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-sm font-semibold text-gray-100 shadow-sm hover:bg-gray-800">
                                Nova categoria
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-400">Total de produtos</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $totalProducts }}</p>
                    </div>

                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-400">Categorias</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $totalCategories }}</p>
                    </div>

                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-400">Estoque baixo</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $lowStockProducts }}</p>
                    </div>

                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-400">Valor em estoque</p>
                        <p class="mt-2 text-3xl font-bold text-white">
                            R$ {{ number_format($totalStockValue, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                    <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Estoque por categoria</h3>
                            <p class="text-sm text-gray-400">Quantidade total de produtos cadastrados em cada categoria.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse ($stockByCategory as $categoryStock)
                            @php
                                $percentage = $categoryStock['quantity'] > 0
                                    ? ($categoryStock['quantity'] / $maxStockByCategory) * 100
                                    : 0;
                            @endphp

                            <div class="grid gap-2 sm:grid-cols-[160px_1fr_64px] sm:items-center">
                                <p class="text-sm font-medium text-gray-200">{{ $categoryStock['name'] }}</p>

                                <div class="h-3 overflow-hidden rounded-full bg-gray-800">
                                    <div class="h-full rounded-full bg-purple-600" style="width: {{ $percentage }}%"></div>
                                </div>

                                <p class="text-sm font-semibold text-white sm:text-right">{{ $categoryStock['quantity'] }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Nenhuma categoria cadastrada.</p>
                        @endforelse
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-[1fr_280px]">
                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white">Ultimos produtos cadastrados</h3>
                                <p class="text-sm text-gray-400">Consulta rapida dos itens mais recentes.</p>
                            </div>

                            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-purple-300 hover:text-purple-200">
                                Ver todos
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse text-left text-sm">
                                <thead>
                                    <tr class="border-b border-gray-800 text-gray-400">
                                        <th class="py-3 pr-4 font-semibold">Produto</th>
                                        <th class="py-3 pr-4 font-semibold">Categoria</th>
                                        <th class="py-3 pr-4 font-semibold">Quantidade</th>
                                        <th class="py-3 font-semibold">Preco</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse ($latestProducts as $product)
                                        <tr class="border-b border-gray-800 last:border-b-0">
                                            <td class="py-3 pr-4 font-medium text-white">{{ $product->name }}</td>
                                            <td class="py-3 pr-4 text-gray-300">{{ $product->category->name }}</td>
                                            <td class="py-3 pr-4">
                                                @if ($product->quantity <= 10)
                                                    <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">
                                                        {{ $product->quantity }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-300">{{ $product->quantity }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 text-gray-300">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-6 text-center text-gray-400">
                                                Nenhum produto cadastrado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-white">Acessos rapidos</h3>
                        <div class="mt-4 grid gap-3">
                            <a href="{{ route('products.index') }}" class="rounded-md border border-gray-800 px-4 py-3 text-sm font-semibold text-gray-200 hover:bg-gray-800">
                                Gerenciar produtos
                            </a>

                            <a href="{{ route('categories.index') }}" class="rounded-md border border-gray-800 px-4 py-3 text-sm font-semibold text-gray-200 hover:bg-gray-800">
                                Gerenciar categorias
                            </a>

                            <a href="{{ route('products.report') }}" class="rounded-md border border-gray-800 px-4 py-3 text-sm font-semibold text-gray-200 hover:bg-gray-800">
                                Relatorio de produtos
                            </a>

                            <a href="{{ route('products.report.pdf') }}" class="rounded-md border border-gray-800 px-4 py-3 text-sm font-semibold text-gray-200 hover:bg-gray-800">
                                Gerar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
