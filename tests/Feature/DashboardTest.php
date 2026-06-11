<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

test('authenticated user can see dashboard information', function () {
    $category = Category::factory()->create([
        'name' => 'Refrigerantes',
    ]);

    Product::factory()->create([
        'name' => 'Coca-Cola 2L',
        'quantity' => 8,
        'price' => 9.90,
        'category_id' => $category->id,
    ]);

    $user = User::factory()->create([
        'name' => 'Bernardo Signor',
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response
        ->assertSuccessful()
        ->assertSee('Bem-vindo, Bernardo Signor!')
        ->assertSee('Area administrativa')
        ->assertSee('Total de produtos')
        ->assertSee('Categorias')
        ->assertSee('Estoque baixo')
        ->assertSee('Estoque por categoria')
        ->assertSee('Coca-Cola 2L')
        ->assertSee('Refrigerantes');
});
