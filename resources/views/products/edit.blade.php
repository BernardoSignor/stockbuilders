<x-app-layout>
    <div class="mx-auto w-full max-w-2xl rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-bold text-white">Editar Produto</h1>

        @include('products.form', [
            'action' => route('products.update', $product),
            'method' => 'PUT',
            'product' => $product,
            'button' => 'Atualizar',
        ])
    </div>
</x-app-layout>
