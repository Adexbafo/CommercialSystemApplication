<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function adminIndex()
{
    $products = Product::all();
    return view('admin.products.index', compact('products'));
}


      
    /**
     * Display the items listing on the dashboard.
     * Use this for future edits to modify how items are sorted or filtered.
     */
    public function index(Request $request)
{
    // Use the Eloquent Model to get data from the database
    $query = \App\Models\Product::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    // This returns a Collection of OBJECTS
    $products = $query->get(); 

    return view('dashboard', compact('products'));
}


}