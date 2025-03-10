<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

// AUTH
Auth::routes();

// GUEST
Route::get('/', [UserController::class, 'viewHomePage'])->name('home');
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');

// CUSTOMER and ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/order/{order}', [OrderController::class, 'show_order_detail'])->name('show_order_detail');
    Route::post('/check-availability', [OrderController::class, 'checkAvailability'])->name('check_availability');
});

// CUSTOMER
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/product/{product}',[ProductController::class, 'show_product'])->name('show_product');
    Route::get('/transaction', [OrderController::class, 'show_order'])->name('show_order');
    Route::get('/transaction/{order}/edit',[OrderController::class, 'reschedule'])->name('reschedule');
    Route::patch('/transaction/{order}/reschedule',[OrderController::class, 'reschedule_order'])->name('reschedule_order');
    Route::patch('/transaction/{order}/cancel', [OrderController::class, 'cancel_order'])->name('cancel_order');
    Route::post('/order/{product}', [OrderController::class, 'make_order'])->name('make_order');
});

// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    // CRUD PRODUCT for ADMIN
    Route::get('/products/create', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/products/create', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/products', [ProductController::class, 'index_product_admin'])->name('index_product_admin');
    Route::get('/products/{product}/edit',[ProductController::class, 'edit_product'])->name('edit_product');
    Route::patch('/products/{product}/update',[ProductController::class, 'update_product'])->name('update_product');
    Route::delete('/products/{product}',[ProductController::class, 'delete_product'])->name('delete_product');

    // CRUD ORDER for ADMIN
    Route::get('/order', [OrderController::class, 'show_all_order'])->name('show_all_order');
    // Route::get('/order/{order}', [OrderController::class, 'show_order_detail'])->name('show_order_detail');
    Route::get('/order/{order}/edit',[OrderController::class, 'edit_order'])->name('edit_order');
    Route::patch('/order/{order}/update',[OrderController::class, 'update_order'])->name('update_order');
    Route::patch('/order/{order}/cancel', [OrderController::class, 'cancel_order_admin'])->name('cancel_order_admin');
    Route::patch('/order/{order}/complete', [OrderController::class, 'complete_order_admin'])->name('complete_order_admin');

    Route::get('/orders', [OrderController::class, 'index'])->name('order_list');
    Route::get('/orders/report', [OrderController::class, 'export_report'])->name('order_report');

    //Report Routes for ADMIN
    Route::get('/reports', [ReportController::class, 'index_report'])->name('view_report');
    Route::get('/get-monthly-data/{year}', [ReportController::class, 'getMonthlyData'])->name('getMonthlyData');

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/send-email', function () {
    Mail::to('edwardwijaya8765@gmail.com')->send(new \App\Mail\ExampleMail());
    return 'Email Sent';
});
