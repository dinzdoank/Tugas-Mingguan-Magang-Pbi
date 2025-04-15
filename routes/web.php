<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;

// Route untuk halaman utama
Route::get('/', [ProductController::class, 'index'])->name('home');

// Route untuk halaman admin
Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
