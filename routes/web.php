<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('content.landing');
});

Route::get('/login', function () {
  return view('content.auth.login');
})->name('login');
