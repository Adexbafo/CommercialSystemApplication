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
    $query = Product::query();

    // Future edit: Add category filtering here
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    $products = $query->get();

    return view('dashboard', compact('products'));
}


}