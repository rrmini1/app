<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/content/landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('content/dashboard/dashboards-analytics');
})->name('dashboard');

Route::get('/login', function () {
  return view('content.auth.login');
})->name('login');
