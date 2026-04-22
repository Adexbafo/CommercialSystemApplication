<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Future edit: You can add more items here or use a Factory for 100+ items.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic Watch',
                'description' => 'A timeless piece for your collection.',
                'price' => 150.00,
                'image_url' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'High-quality sound with noise cancellation.',
                'price' => 89.99,
                'image_url' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Leather Wallet',
                'description' => 'Genuine leather with multiple card slots.',
                'price' => 45.50,
                'image_url' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Smart Coffee Mug',
                'description' => 'Keeps your drink at the perfect temperature.',
                'price' => 30.00,
                'image_url' => 'https://via.placeholder.com/150'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}