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
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
Route::get('/product/{product}',[ProductController::class, 'show_product'])->name('show_product');

Route::get('/transaction', [OrderController::class, 'show_order'])->name('show_order');
Route::get('/transaction/{order}/edit',[OrderController::class, 'reschedule'])->name('reschedule');
Route::patch('/transaction/{order}/cancel', [OrderController::class, 'cancel_order'])->name('cancel_order');
Route::post('/order/{product}', [OrderController::class, 'make_order'])->name('make_order');

// admin
// Route::get('/admin', [AdminController::class, 'viewAdminHome'])->name('home_admin');
// udah gakepake yang admin home ini, nanti aja apusnya

// CRUD PRODUCT for ADMIN
Route::get('/products/create', [ProductController::class, 'create_product'])->name('create_product');
Route::post('/products/create', [ProductController::class, 'store_product'])->name('store_product');
Route::get('/products', [ProductController::class, 'index_product_admin'])->name('index_product_admin');
Route::get('/product/{product}/edit',[ProductController::class, 'edit_product'])->name('edit_product');
Route::patch('/product/{product}/update',[ProductController::class, 'update_product'])->name('update_product');
Route::delete('/product/{product}',[ProductController::class, 'delete_product'])->name('delete_product');

// CRUD ORDER for ADMIN
// EDITnya blm
Route::get('/order', [OrderController::class, 'show_all_order'])->name('show_all_order');
Route::get('/order/{order}', [OrderController::class, 'show_order_detail'])->name('show_order_detail');
Route::get('/order/{order}/edit',[OrderController::class, 'edit_order'])->name('edit_order');
Route::patch('/order/{order}/update',[OrderController::class, 'update_order'])->name('update_order');
Route::patch('/order/{order}/reschedule',[OrderController::class, 'reschedule_order'])->name('reschedule_order');
Route::patch('/order/{order}/cancel', [OrderController::class, 'cancel_order_admin'])->name('cancel_order_admin');
Route::patch('/order/{order}/complete', [OrderController::class, 'complete_order_admin'])->name('complete_order_admin');

// KALO MAU BUAT KEKNYA HARUS SATU PERSATU
// DEH ANTARA ADMIN DULU ATAU CUSTOMER DULU
// GABISA DUA DUANYA NIH GAJELAS APLIKASINYA COK
// JADI KALO MAU GANTI KE ADMIN YANG PRODUCT DI CUSTOMER DI COMMENT DULU

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
