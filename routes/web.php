<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);

// Routes untuk user biasa
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\UserLoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\UserLoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/order/konfirmasi/{order}', [\App\Http\Controllers\OrderController::class, 'showConfirmation'])->name('order.confirmation');
    Route::post('/order/konfirmasi/{order}', [\App\Http\Controllers\OrderController::class, 'confirmPayment'])->name('order.confirmPayment');
    // Route untuk detail order user
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'userOrders'])->name('user.orders');
    // Halaman produk untuk user (bisa diakses tanpa login)
    Route::get('/produk', [\App\Http\Controllers\ProductController::class, 'index'])->name('user.products');
    Route::get('/order/create/{product}', [\App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
});

// Route publik untuk simpan pesan kontak
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Routes untuk admin
Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    });

    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);
        // Route untuk approve/reject order
        Route::post('/orders/{order}/approve', [\App\Http\Controllers\OrderController::class, 'approvePayment'])->name('admin.orders.approve');
        Route::post('/orders/{order}/reject', [\App\Http\Controllers\OrderController::class, 'rejectPayment'])->name('admin.orders.reject');
        // Route untuk halaman daftar order admin
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'indexAdmin'])->name('admin.orders.index');
        // Route untuk halaman daftar user admin
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class, ['as' => 'admin'])->except(['create', 'store', 'show']);
        // Route untuk statistik order admin
        Route::get('/order-stats', [\App\Http\Controllers\Admin\OrderStatsController::class, 'index'])->name('admin.orders.stats');
        // Route untuk melihat daftar pesan kontak
        Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('admin.contacts.index');
        Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
    });
});

require __DIR__.'/auth.php';
