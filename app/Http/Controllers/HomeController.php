<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::query()
            ->with('category')
            ->where('quantity', '>', 0)
            ->when($request->search, function ($query, string $search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($query, string $categoryId): void {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->get();

        return view('welcome', compact('products', 'categories'));
    }
}
