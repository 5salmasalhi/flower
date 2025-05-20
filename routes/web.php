<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as PublicProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [PublicProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout/guest', [App\Http\Controllers\CheckoutController::class, 'guest'])->name('checkout.guest');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/thankyou/{order}', [App\Http\Controllers\CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
});

require __DIR__.'/auth.php';