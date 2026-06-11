<?php

use App\Models\Category;
use App\Models\Product;

test('guest can see public home and available products', function () {
    $category = Category::factory()->create([
        'name' => 'Refrigerantes',
    ]);

    Product::factory()->create([
        'name' => 'Coca-Cola 2L',
        'quantity' => 12,
        'price' => 9.90,
        'category_id' => $category->id,
    ]);

    $response = $this->get('/');

    $response
        ->assertSuccessful()
        ->assertSee('Area publica')
        ->assertSee('Produtos disponiveis')
        ->assertSee('Coca-Cola 2L')
        ->assertSee('Refrigerantes');
});
