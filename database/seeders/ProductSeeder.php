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
    // Clear existing products first to avoid duplicates
    \App\Models\Product::truncate();

    $products = [
        [
            'name' => 'Classic Watch',
            'description' => 'A timeless piece for your wrist with leather straps.',
            'price' => 150.00
        ],
        [
            'name' => 'Wireless Earbuds',
            'description' => 'Noise-cancelling high-fidelity audio.',
            'price' => 89.99
        ],
        [
            'name' => 'Smart Coffee Mug',
            'description' => 'App-controlled heating to keep your drink perfect.',
            'price' => 30.00
        ],
        [
            'name' => 'Leather Wallet',
            'description' => 'Genuine leather with RFID blocking technology.',
            'price' => 45.50
        ]
    ];

    foreach ($products as $product) {
        \App\Models\Product::create($product);
    }
}
}