<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the items listing on the dashboard.
     * Use this for future edits to modify how items are sorted or filtered.
     */
    public function index(Request $request)
{
    // 1. Your original list of products
    $allProducts = [
        ['id' => 1, 'name' => 'Classic Watch', 'price' => 150.00, 'description' => 'A timeless piece for your wrist.'],
        ['id' => 2, 'name' => 'Wireless Earbuds', 'price' => 89.99, 'description' => 'High-quality sound without the wires.'],
        ['id' => 3, 'name' => 'Smart Coffee Mug', 'price' => 30.00, 'description' => 'Keeps your drink at the perfect temperature.'],
        ['id' => 4, 'name' => 'Leather Wallet', 'price' => 45.50, 'description' => 'Genuine leather with RFID protection.'],
    ];

    $search = $request->input('search');

    // 2. If there is a search term, filter the array
    if ($search) {
        $products = array_filter($allProducts, function ($product) use ($search) {
            return str_contains(strtolower($product['name']), strtolower($search)) || 
                   str_contains(strtolower($product['description']), strtolower($search));
        });
    } else {
        $products = $allProducts;
    }

    return view('dashboard', compact('products'));
}


}