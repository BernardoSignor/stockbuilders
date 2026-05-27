@extends('layouts.site')

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold">Produtos disponiveis</h1>
                <p class="text-sm text-gray-600">Consulta publica de produtos da distribuidora.</p>
            </div>

            <a href="{{ route('products.index') }}" class="w-fit rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                Gerenciar produtos
            </a>
        </div>

        <form method="GET" action="{{ route('home') }}" class="grid gap-3 rounded border border-gray-200 bg-white p-4 sm:grid-cols-[1fr_220px_auto]">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar produto"
                class="rounded border border-gray-300 px-3 py-2"
            >

            <select name="category_id" class="rounded border border-gray-300 px-3 py-2">
                <option value="">Todas categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">
                Filtrar
            </button>
        </form>

        <div class="overflow-x-auto rounded border border-gray-200 bg-white">
            <table class="w-full border-collapse text-left text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="border-b border-gray-200 px-4 py-3">Produto</th>
                        <th class="border-b border-gray-200 px-4 py-3">Categoria</th>
                        <th class="border-b border-gray-200 px-4 py-3">Estoque</th>
                        <th class="border-b border-gray-200 px-4 py-3">Preco</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="border-b border-gray-100 px-4 py-3 font-medium">{{ $product->name }}</td>
                            <td class="border-b border-gray-100 px-4 py-3">{{ $product->category->name }}</td>
                            <td class="border-b border-gray-100 px-4 py-3">{{ $product->quantity }}</td>
                            <td class="border-b border-gray-100 px-4 py-3">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">Nenhum produto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
