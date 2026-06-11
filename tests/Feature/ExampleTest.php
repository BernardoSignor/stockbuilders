<?php

test('main route shows public stock page', function () {
    $response = $this->get('/');

    $response
        ->assertSuccessful()
        ->assertSee('StockBuilderS')
        ->assertSee('Area publica');
});
