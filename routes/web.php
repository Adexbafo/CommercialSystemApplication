<?php

use App\Http\Controllers\CartController; // Moved to the top
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Added for the /orders route

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| This is where you register web routes for your CommercialSystemApplication.
*/


// Home Route (Optional: redirect to dashboard or a welcome page)
Route::get('/', function () {
    return view('welcome');
});

// The Dashboard: Shows the item listing with mock prices
Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Cart Routes: For adding items to the session
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Order History: Shows what the user has previously bought
Route::get('/orders', function () {
    // Note: Ensure you have a 'hasMany' relationship in your User Model
    $orders = Auth::user()->orders; 
    return view('orders.history', compact('orders'));
})->middleware(['auth']);

// Profile Routes (Breeze Defaults)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


// Auth routes (Login, Register, etc.)
require __DIR__.'/auth.php';