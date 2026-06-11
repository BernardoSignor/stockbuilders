<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('api login returns token data', function () {
    User::factory()->create([
        'name' => 'Bernardo Signor',
        'email' => 'bernardo@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->postJson('/api/v1/login', [
        'email' => 'bernardo@example.com',
        'password' => 'secret123',
    ]);

    $response
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('token_type', 'Bearer')
        ->assertJsonPath('user.email', 'bernardo@example.com')
        ->assertJsonStructure([
            'token',
        ]);
});

test('authenticated api user can list products', function () {
    $category = Category::factory()->create([
        'name' => 'Refrigerantes',
    ]);

    Product::factory()->create([
        'name' => 'Coca-Cola 2L',
        'quantity' => 8,
        'price' => 9.90,
        'category_id' => $category->id,
    ]);

    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->getJson('/api/v1/products');

    $response
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.0.name', 'Coca-Cola 2L')
        ->assertJsonPath('data.0.category.name', 'Refrigerantes');
});

test('authenticated api user can see one product', function () {
    $category = Category::factory()->create([
        'name' => 'Refrigerantes',
    ]);

    $product = Product::factory()->create([
        'name' => 'Coca-Cola 2L',
        'category_id' => $category->id,
    ]);

    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)->getJson("/api/v1/products/{$product->id}");

    $response
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.name', 'Coca-Cola 2L')
        ->assertJsonPath('data.category.name', 'Refrigerantes');
});
