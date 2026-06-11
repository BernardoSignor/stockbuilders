<x-app-layout>
    <div class="mx-auto w-full rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-bold text-white">Relatorio de Produtos</h1>

        <form method="GET" action="{{ route('products.report.pdf') }}" class="space-y-4">
            <div>
                <x-input-label for="name" value="Nome" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ request('name') }}" />
            </div>

            <div>
                <x-input-label for="category_id" value="Categoria" />
                <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-950 text-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="min_quantity" value="Quantidade minima" />
                    <x-text-input id="min_quantity" name="min_quantity" type="number" class="mt-1 block w-full" value="{{ request('min_quantity') }}" />
                </div>

                <div>
                    <x-input-label for="max_quantity" value="Quantidade maxima" />
                    <x-text-input id="max_quantity" name="max_quantity" type="number" class="mt-1 block w-full" value="{{ request('max_quantity') }}" />
                </div>
            </div>

            <div class="flex gap-2">
                <x-primary-button>Exportar PDF</x-primary-button>

                <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-200 shadow-sm hover:bg-gray-800">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
