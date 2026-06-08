<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard')->name('home');

Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $lowStockProducts = Product::where('quantity', '<=', 10)->count();
    $totalStockValue = Product::selectRaw('COALESCE(SUM(quantity * price), 0) as total')->value('total');
    $latestProducts = Product::with('category')->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalProducts',
        'totalCategories',
        'lowStockProducts',
        'totalStockValue',
        'latestProducts'
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
