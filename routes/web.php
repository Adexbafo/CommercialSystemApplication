<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::get('/admin/products', [ProductController::class, 'adminIndex'])
    ->middleware(['auth', 'can:admin'])
    ->name('admin.products');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/orders', function () {
    $orders = Auth::user()->orders()->latest()->get(); 
    return view('orders.history', compact('orders'));
})->middleware(['auth'])->name('orders.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/orders/{order}/download', function (\App\Models\Order $order) {
    // Verify the user owns the order
    if ($order->user_id !== Auth::id()) { abort(403); }

    $pdf = Pdf::loadView('orders.pdf', compact('order'));
    return $pdf->download('order-receipt-'.$order->id.'.pdf');
})->name('orders.download');


require __DIR__.'/auth.php';