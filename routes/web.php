<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/products', [ItemController::class, 'viewAllItem'])->name('products');
Route::get('/products/{id}', [ItemController::class, 'show'])->name('product.detail');
