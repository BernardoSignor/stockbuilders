<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/publico', [HomeController::class, 'index'])->name('public.home');

Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $lowStockProducts = Product::where('quantity', '<=', 10)->count();
    $totalStockValue = Product::selectRaw('COALESCE(SUM(quantity * price), 0) as total')->value('total');
    $latestProducts = Product::with('category')->latest()->take(5)->get();
    $stockByCategory = Category::query()
        ->withSum('products as total_quantity', 'quantity')
        ->orderBy('name')
        ->get()
        ->map(fn (Category $category): array => [
            'name' => $category->name,
            'quantity' => (int) ($category->total_quantity ?? 0),
        ]);
    $maxStockByCategory = max($stockByCategory->max('quantity') ?? 0, 1);

    return view('dashboard', compact(
        'totalProducts',
        'totalCategories',
        'lowStockProducts',
        'totalStockValue',
        'latestProducts',
        'stockByCategory',
        'maxStockByCategory'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/report', [ProductsController::class, 'report'])->name('products.report');
    Route::get('/products/report/pdf', [ProductsController::class, 'reportPdf'])->name('products.report.pdf');

    Route::resource('products', ProductsController::class)->except(['show']);
    Route::resource('categories', CategoriesController::class)->except(['show']);
});

require __DIR__.'/auth.php';
