<?php

use App\Models\User;

test('guest must login to access administration pages', function () {
    $this->get('/dashboard')->assertRedirect('/login');
    $this->get('/products')->assertRedirect('/login');
    $this->get('/categories')->assertRedirect('/login');
});

test('logged user can manage products and categories', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/products/create')
        ->assertSuccessful()
        ->assertSee('Cadastrar Produto');

    $this->actingAs($user)
        ->get('/categories/create')
        ->assertSuccessful()
        ->assertSee('Cadastrar Categoria');
});
