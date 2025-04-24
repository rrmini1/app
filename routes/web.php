<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/content/landing');
})->name('landing');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('content/dashboard/dashboards-analytics');
    })->name('dashboard');
});

Route::get('/test-mail', function() {
    try {
        Mail::raw('Test email', function($message) {
            $message->to('test@example.com')->subject('Test');
        });
        return 'Email sent successfully';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
