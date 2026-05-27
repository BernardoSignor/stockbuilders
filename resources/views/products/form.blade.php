@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $product?->name) }}" />
    </div>

    <div>
        <x-input-label for="description" value="Descricao" />
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description', $product?->description) }}" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-label for="quantity" value="Quantidade" />
            <x-text-input id="quantity" name="quantity" type="number" class="mt-1 block w-full" value="{{ old('quantity', $product?->quantity) }}" />
        </div>

        <div>
            <x-input-label for="price" value="Preco" />
            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price', $product?->price) }}" />
        </div>
    </div>

    <div>
        <x-input-label for="category_id" value="Categoria" />
        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">Selecione</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div x-data="{ imageName: 'Nenhuma imagem selecionada' }">
        <x-input-label for="image" value="Imagem" />

        <div class="mt-1 flex flex-wrap items-center gap-2">
            <label for="image" class="inline-flex cursor-pointer items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Escolher imagem
            </label>

            <span x-text="imageName" class="text-sm text-gray-700 dark:text-gray-300"></span>
        </div>

        <input
            id="image"
            name="image"
            type="file"
            accept="image/*"
            class="sr-only"
            x-on:change="imageName = $event.target.files.length ? $event.target.files[0].name : 'Nenhuma imagem selecionada'"
        >
    </div>

    <div class="flex flex-wrap gap-2">
        <x-primary-button>
            {{ $button }}
        </x-primary-button>

        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700">
            Voltar
        </a>
    </div>
</form>
