<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Route Produk
// Bisa diakses tanpa login
Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/produk/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

// Route khusus Customer
// Perlu login + role customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/webhook/midtrans', [MidtransWebhookController::class, 'handle'])
    ->name('webhook.midtrans');

// Route khusus Pharmacist
// Perlu login + role pharmacist
Route::middleware(['auth', 'role:pharmacist'])
    ->prefix('pharmacist')
    ->name('pharmacist.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return 'Pharmacist Dashboard (sementara) — akan dibangun di Minggu 6';
        })->name('dashboard');
    });

// Route Cart, Checkout & Pesanan
// Perlu login
Route::middleware(['auth'])->group(function () {

    // Cart
    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/keranjang/{product}', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/keranjang/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/keranjang/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Pesanan
    Route::get('/pesanan', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/pesanan/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    // Resep
    Route::get('/resep-saya', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/upload-resep', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/upload-resep', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/resep/{prescription}/download', [PrescriptionController::class, 'download'])->name('prescriptions.download');

    // Payment
    Route::get('/checkout/{order}/payment', [PaymentController::class, 'show'])->name('checkout.payment');

});

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';