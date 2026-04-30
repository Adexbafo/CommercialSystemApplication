<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- Public Routes ---
Route::get('/', function () {
    return view('welcome');
});

// --- Customer Routes ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Marketplace
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

    // Cart & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout/{product}', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/cart/checkout', [CheckoutController::class, 'processCart'])->name('cart.checkout');
    Route::get('/checkout/success/{order}', function (Order $order) {
        return view('checkout.success', compact('order'));
    })->name('checkout.success');

    // Customer's Personal Order History
    Route::get('/orders', function () {
        $orders = Auth::user()->orders()->latest()->get(); 
        return view('orders.history', compact('orders'));
    })->name('orders.index');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Admin Authentication Routes ---
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// --- Admin Dedicated Routes ---
Route::middleware(['admin_redirect', 'can:admin'])->prefix('admin')->group(function () {
    
    // Admin Home/Dashboard
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Product Management
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Global Order Management
    Route::get('/orders', [CheckoutController::class, 'adminOrders'])->name('admin.orders');
});

require __DIR__.'/auth.php';