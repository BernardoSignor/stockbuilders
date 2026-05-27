<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function report(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.report', compact('categories'));
    }

    public function reportPdf(Request $request): Response
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.description',
                'products.quantity',
                'products.price',
                'products.image',
                'products.category_id',
                'categories.name as category_name',
                'products.created_at',
                'products.updated_at',
            )
            ->when($request->name, fn ($query, $name) => $query->where('products.name', 'like', "%{$name}%"))
            ->when($request->category_id, fn ($query, $categoryId) => $query->where('products.category_id', $categoryId))
            ->when($request->min_quantity, fn ($query, $quantity) => $query->where('products.quantity', '>=', $quantity))
            ->when($request->max_quantity, fn ($query, $quantity) => $query->where('products.quantity', '<=', $quantity))
            ->orderBy('products.name')
            ->get();

        return Pdf::loadView('products.report-pdf', compact('products'))
            ->download('relatorio-produtos.pdf');
    }

    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::query()
            ->with('category')
            ->when($request->search, function ($query, string $search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($query, string $categoryId): void {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return to_route('products.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return to_route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('products.index')->with('success', 'Produto excluido com sucesso.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'min:2', 'max:80'],
            'description' => ['nullable', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'gt:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
