<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;

// Route untuk halaman utama
Route::get('/', [ProductController::class, 'index'])->name('home');

// Route untuk halaman admin
Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
