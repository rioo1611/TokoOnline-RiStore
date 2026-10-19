<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - MYKONOS Official Parfums Store
|--------------------------------------------------------------------------
*/

// Home & Catalog
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sunforged', [HomeController::class, 'sunforged'])->name('sunforged');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{id}/quick-view', [ProductController::class, 'quickView'])->name('products.quick-view');

// Shopping Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/api/cart/summary', [CartController::class, 'getSummary'])->name('cart.summary');

// Checkout Flow
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');

// About & Contact Pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// Admin Dashboard & Management
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
});
