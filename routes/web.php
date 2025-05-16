<?php

declare(strict_types=1);

use App\Http\Controllers\Crud\UserController;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/content/landing');
})->name('landing');


Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('content/dashboard/dashboards-analytics');
    })->name('dashboard');

    Route::resource('users', UserController::class); // all users
//    Route::get('clients', [UserController::class, 'clients'])->name('clients');
//    Route::get('users', function (Request $request) {
//        dd($request->input('roles'));
//    })->name('users');
//    Route::get('developer', [UserController::class, 'usersByRole'])->name('developers');
//    Route::get('client', [UserController::class, 'usersByRole'])->name('clients');
});


//Route::get('/test-mail', function() {
//    try {
//        Mail::raw('Test email', function($message) {
//            $message->to('test@example.com')->subject('Test');
//        });
//        return 'Email sent successfully';
//    } catch (\Exception $e) {
//        return 'Error: ' . $e->getMessage();
//    }
//});
