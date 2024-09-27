<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// customer
Route::get('/', [HomeController::class, 'viewHomePage'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::get('/products', [ProductController::class, 'viewAllProduct'])->name('products');
// Route::get('/{product}', [ProductController::class, 'viewDetailProduct'])->name('product_detail');


// admin
Route::get('/admin', [HomeController::class, 'viewAdminHome'])->name('home_admin');
Route::get('/products', [AdminController::class, 'viewAllProduct'])->name('products');
Route::get('/create', [ProductController::class, 'createProduct'])->name('products.create');
Route::post('/store', [ProductController::class, 'storeProduct'])->name('products.store');
Route::get('/orders', [OrderController::class, 'viewAllOrders'])->name('view_order');
Route::get('/{product}', [ProductController::class, 'editProduct'])->name('edit_product');
Route::delete('/products/{product}', [ProductController::class, 'deleteProduct'])->name('delete_product');

// KALO MAU BUAT KEKNYA HARUS SATU PERSATU
// DEH ANTARA ADMIN DULU ATAU CUSTOMER DULU
// GABISA DUA DUANYA NIH GAJELAS APLIKASINYA COK
// JADI KALO MAU GANTI KE ADMIN YANG PRODUCT DI CUSTOMER DI COMMENT DULU
