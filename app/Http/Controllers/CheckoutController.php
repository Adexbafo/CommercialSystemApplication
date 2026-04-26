<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Handles "Buy Now" from Marketplace
     */
    public function store(Product $product)
    {
        if ($product->quantity <= 0) {
            return back()->with('error', 'Sorry, this item is out of stock!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $product->price,
            'status' => 'completed',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        $product->decrement('quantity', 1);

        return redirect()->route('checkout.success', $order->id)
                         ->with('success', 'Purchase successful!');
    }

    /**
     * Handles "Proceed to Checkout" from Shopping Cart
     */
    public function processCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('dashboard')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create the Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'completed'
        ]);

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            
            if ($product) {
                $order->items()->create([
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                $product->decrement('quantity', $details['quantity']);
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    public function adminOrders()
{
    // Fetch all orders with their users and items
    $orders = Order::with(['user', 'items.product'])->latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}
}