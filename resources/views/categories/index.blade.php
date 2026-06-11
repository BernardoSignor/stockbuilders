<x-app-layout>
    <div class="mx-auto w-full rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-bold text-white">Categorias</h1>

            <a href="{{ route('categories.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-purple-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-purple-600">
                Cadastrar
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded border border-green-900/50 bg-green-950/40 p-3 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded border border-red-900/50 bg-red-950/40 p-3 text-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-md border border-gray-800">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-950">
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Nome</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Produtos</th>
                        <th class="border-b border-gray-800 px-4 py-3 text-left text-gray-200">Acoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-800/60">
                            <td class="px-4 py-3 font-medium text-white">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $category->products_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="rounded bg-gray-700 px-3 py-1 text-white hover:bg-gray-600">Editar</a>

                                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
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
                            <td colspan="3" class="px-4 py-6 text-center text-gray-400">Nenhuma categoria cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
