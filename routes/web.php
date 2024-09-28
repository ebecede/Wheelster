<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// customer
Route::get('/', [UserController::class, 'viewHomePage'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
// Route::get('/product/{product}',[ProductController::class, 'show_product'])->name('show_product');

// CRUD for customer
Route::get('/order/create/{product}', [OrderController::class, 'create_order'])->name('create_order');
Route::post('/order/create', [OrderController::class, 'store_order'])->name('store_order');

// admin
Route::get('/admin', [AdminController::class, 'viewAdminHome'])->name('home_admin');
// Route::get('/products', [ProductController::class, 'viewAllProductAdmin'])->name('products');

// CRUD PRODUCT for ADMIN
Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');
Route::get('/products', [ProductController::class, 'index_product_admin'])->name('index_product_admin');
Route::get('/product/{product}/edit',[ProductController::class, 'edit_product'])->name('edit_product');
Route::patch('/product/{product}/update',[ProductController::class, 'update_product'])->name('update_product');
Route::delete('/product/{product}',[ProductController::class, 'delete_product'])->name('delete_product');

Route::get('/order', [OrderController::class, 'viewAllOrders'])->name('view_order');


// KALO MAU BUAT KEKNYA HARUS SATU PERSATU
// DEH ANTARA ADMIN DULU ATAU CUSTOMER DULU
// GABISA DUA DUANYA NIH GAJELAS APLIKASINYA COK
// JADI KALO MAU GANTI KE ADMIN YANG PRODUCT DI CUSTOMER DI COMMENT DULU

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
