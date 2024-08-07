<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
