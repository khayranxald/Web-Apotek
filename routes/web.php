<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/', [HomeController::class, 'index']);

// Halaman Statis
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Artikel Kesehatan
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Produk — bisa diakses tanpa login
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// Webhook Midtrans — tanpa auth, tanpa CSRF (dikecualikan di bootstrap/app.php)
Route::post('/webhook/midtrans', [MidtransWebhookController::class, 'handle'])->name('webhook.midtrans');

// Dashboard Customer — perlu login + role customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Dashboard Pharmacist — perlu login + role pharmacist
Route::middleware(['auth', 'role:pharmacist'])
    ->prefix('pharmacist')
    ->name('pharmacist.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return 'Pharmacist Dashboard (sementara) - akan dibangun di Minggu 6';
        })->name('dashboard');
    });

// Route Cart, Checkout, Pesanan, Resep (lihat & unduh) — perlu login
Route::middleware(['auth'])->group(function () {

    // Cart
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/keranjang/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Payment
    Route::get('/checkout/{order}/payment', [PaymentController::class, 'show'])->name('checkout.payment');

    // Pesanan
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Resep — lihat daftar & unduh file (boleh role apapun yang login)
    Route::get('/resep-saya', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/resep/{prescription}/download', [PrescriptionController::class, 'download'])->name('prescriptions.download');
});

// Upload Resep — perlu login + role customer (khusus, bukan admin/pharmacist)
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/upload-resep', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/upload-resep', [PrescriptionController::class, 'store'])->name('prescriptions.store');
});

// Profile (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';