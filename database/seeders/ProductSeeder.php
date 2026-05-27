<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $refrigerantes = Category::firstOrCreate(['name' => 'Refrigerantes']);
        $aguas = Category::firstOrCreate(['name' => 'Aguas']);
        $sucos = Category::firstOrCreate(['name' => 'Sucos']);

        Product::firstOrCreate(
            ['name' => 'Coca-Cola 2L'],
            [
                'description' => 'Refrigerante garrafa 2 litros',
                'quantity' => 30,
                'price' => 9.90,
                'category_id' => $refrigerantes->id,
            ],
        );

        Product::firstOrCreate(
            ['name' => 'Agua Mineral 500ml'],
            [
                'description' => 'Agua mineral sem gas',
                'quantity' => 80,
                'price' => 2.50,
                'category_id' => $aguas->id,
            ],
        );

        Product::firstOrCreate(
            ['name' => 'Suco de Uva 1L'],
            [
                'description' => 'Suco integral de uva',
                'quantity' => 20,
                'price' => 12.90,
                'category_id' => $sucos->id,
            ],
        );
    }
}
