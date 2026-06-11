<?php

use App\Http\Controllers\Api\ProductsControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('loginapi', [ProductsControllerApi::class, 'loginapi']);

Route::prefix('v1')->group(function () {
    Route::post('login', [ProductsControllerApi::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('products', [ProductsControllerApi::class, 'index']);
        Route::get('products/{product}', [ProductsControllerApi::class, 'show']);

        Route::get('user', function (Request $request) {
            return $request->user();
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('products', [ProductsControllerApi::class, 'index']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
