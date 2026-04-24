<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display the public dashboard with search functionality.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->get(); 

        return view('dashboard', compact('products'));
    }

    /**
     * Admin view: List all products for management.
     */
    public function adminIndex()
{
    $products = Product::all();
    // This looks for quantity < 5 in the database
    $lowStockCount = Product::where('quantity', '<', 5)->count(); 
    
    return view('admin.products.index', compact('products', 'lowStockCount'));
}

    /**
     * Show the form for creating a new product.
     */
    public function create() 
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing an existing product.
     */
    public function edit(Product $product) 
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, Product $product) 
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if a new one is uploaded
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

     public function destroy(Product $product)
   {
    // Delete the image file if it exists
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();
    return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
   }

}