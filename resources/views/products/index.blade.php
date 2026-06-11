<x-app-layout>
    <div class="mx-auto w-full rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-bold text-white">Produtos</h1>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('products.report') }}" class="inline-flex items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-200 shadow-sm hover:bg-gray-800">
                    Relatorio
                </a>

                <a href="{{ route('products.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-purple-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-purple-600">
                    Cadastrar
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded border border-green-900/50 bg-green-950/40 p-3 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('products.index') }}" class="grid gap-3 mb-4 sm:grid-cols-[1fr_220px_auto]">
            <x-text-input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar produto"
                class="w-full"
            />

            <select name="category_id" class="rounded-md border-gray-700 bg-gray-950 text-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                <option value="">Todas categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <x-primary-button>
                Filtrar
            </x-primary-button>
        </form>

        <div class="overflow-x-auto rounded-md border border-gray-800">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-950">
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Produto</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Categoria</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Quantidade</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Preco</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Acoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-800/60">
                            <td class="px-4 py-3 font-medium text-white">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $product->category->name }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $product->quantity }}</td>
                            <td class="px-4 py-3 text-gray-300">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="rounded bg-gray-700 px-3 py-1 text-white hover:bg-gray-600">Editar</a>

                                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded bg-red-700 px-3 py-1 text-white hover:bg-red-600">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum produto cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
