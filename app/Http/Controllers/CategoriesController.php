<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:60'],
        ]);

        Category::create($data);

        return to_route('categories.index')->with('success', 'Categoria cadastrada com sucesso.');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:60'],
        ]);

        $category->update($data);

        return to_route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return to_route('categories.index')->with('error', 'Nao e possivel excluir categoria com produtos.');
        }

        $category->delete();

        return to_route('categories.index')->with('success', 'Categoria excluida com sucesso.');
    }
}
