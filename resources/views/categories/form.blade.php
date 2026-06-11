@if ($errors->any())
    <div class="mb-4 rounded border border-red-900/50 bg-red-950/40 p-3 text-red-200">
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $category?->name) }}" />
    </div>

    <div class="flex flex-wrap gap-2">
        <x-primary-button>
            {{ $button }}
        </x-primary-button>

        <a href="{{ route('categories.index') }}" class="inline-flex items-center rounded-md border border-purple-900/50 bg-gray-950 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-200 shadow-sm hover:bg-gray-800">
            Voltar
        </a>
    </div>
</form>
