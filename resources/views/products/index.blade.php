<x-app-layout>
    <div class="w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow mx-auto">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Produtos</h1>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('products.report') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                    Relatorio
                </a>

                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    Cadastrar
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
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

            <select name="category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">Produto</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">Categoria</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">Quantidade</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">Preco</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $product->category->name }}</td>
                            <td class="px-4 py-2 text-gray-900 dark:text-white">{{ $product->quantity }}</td>
                            <td class="px-4 py-2 text-gray-900 dark:text-white">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Editar</a>

                                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-300">Nenhum produto cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
