<x-app-layout>
    <div class="mx-auto w-full max-w-xl rounded-lg border border-purple-950/60 bg-gray-900 p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-bold text-white">Editar Categoria</h1>

        @include('categories.form', [
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'category' => $category,
            'button' => 'Atualizar',
        ])
    </div>
</x-app-layout>
