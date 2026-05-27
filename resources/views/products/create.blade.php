<x-app-layout>
    <div class="w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow mx-auto max-w-2xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Cadastrar Produto</h1>

        @include('products.form', [
            'action' => route('products.store'),
            'method' => 'POST',
            'product' => null,
            'button' => 'Salvar',
        ])
    </div>
</x-app-layout>
