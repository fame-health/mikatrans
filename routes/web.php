<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Route untuk halaman bus
Route::get('/bus', function () {
    return view('bus');
})->name('bus');

// Route untuk halaman travel
Route::get('/travel', function () {
    return view('travel');
})->name('travel');
