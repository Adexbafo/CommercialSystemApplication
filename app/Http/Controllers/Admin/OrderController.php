<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
    $orders = \App\Models\Order::with('user')->latest()->get();
    return view('admin.orders.index', compact('orders'));
}

public function updateStatus(Request $request, \App\Models\Order $order) {
    $order->update(['status' => $request->status]);
    return back()->with('success', 'Order status updated!');
}
}
