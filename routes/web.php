<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'viewHomePage'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/products', [ProductController::class, 'viewAllProduct'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'viewDetailProduct'])->name('productDetail');
