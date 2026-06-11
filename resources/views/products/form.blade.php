@if ($errors->any())
    <div class="mb-4 rounded border border-red-900/50 bg-red-950/40 p-3 text-red-200">
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
        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-950 text-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500">
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
            <label for="image" class="inline-flex cursor-pointer items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-sm font-medium text-gray-200 shadow-sm hover:bg-gray-800">
                Escolher imagem
            </label>

            <span x-text="imageName" class="text-sm text-gray-300"></span>
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

        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-200 shadow-sm hover:bg-gray-800">
            Voltar
        </a>
    </div>
</form>
