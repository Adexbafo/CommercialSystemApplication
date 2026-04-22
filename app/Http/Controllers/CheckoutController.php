<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('dashboard')->with('error', 'Cart is empty!');
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'status' => 'completed',
            'items' => $cart,
        ]);

        // Clear the cart
        session()->forget('cart');

        // Redirect to history
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}