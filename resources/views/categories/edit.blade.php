<x-app-layout>
    <div class="w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow mx-auto max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Editar Categoria</h1>

        @include('categories.form', [
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'category' => $category,
            'button' => 'Atualizar',
        ])
    </div>
</x-app-layout>
