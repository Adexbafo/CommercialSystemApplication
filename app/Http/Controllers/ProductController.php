<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display the public dashboard with search functionality.
     */
    public function index(Request $request)
{
    $query = $request->input('search');

    // If there is a search term, filter the products; otherwise, show all.
    $products = Product::when($query, function ($q) use ($query) {
        return $q->where('name', 'like', '%' . $query . '%')
                 ->orWhere('description', 'like', '%' . $query . '%');
    })->get();

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
    public function create() {
    $categories = Category::all(); // Fetch categories
    return view('admin.products.create', compact('categories'));
}

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'category_id' => 'nullable|exists:categories,id', // Add this
        'image' => 'nullable|image',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id; // THIS LINE IS KEY
    
    if ($request->hasFile('image')) {
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->save();

    return redirect()->route('admin.products')->with('success', 'Product created!');
}

    /**
     * Show the form for editing an existing product.
     */
    public function edit(Product $product) {
    $categories = Category::all(); // Fetch categories
    return view('admin.products.edit', compact('product', 'categories'));
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