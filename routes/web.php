<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('content.landing.index');
});
Route::get('/dashboard', function () {
    return view('content.dashboard.index');
})->name('dashboard');

Route::get('/login', function () {
    return view('content.auth.login');
})->name('login');
Route::get('/register', function () {
    return view('content.auth.register');
})->name('register');
