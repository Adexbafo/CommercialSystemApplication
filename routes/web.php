<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// The Dashboard now uses the ProductController to show items
Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Auth and Profile routes are automatically handled by Breeze

require __DIR__.'/auth.php';
