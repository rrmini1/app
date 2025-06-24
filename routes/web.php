<?php

declare(strict_types=1);

use App\Http\Controllers\Crud\ProjectController;
use App\Http\Controllers\Crud\StageController;
use App\Http\Controllers\Crud\UserController;
//use Illuminate\Support\Facades\Mail;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/content/landing');
})->name('landing');


Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('content/dashboard/dashboards-analytics');
    })->name('dashboard');

    Route::resource('users', UserController::class); // all users

    Route::resource('projects', ProjectController::class);

    Route::post('/projects/{project}/users', [ProjectController::class, 'addUserToProject'])
        ->name('projects.users.store');

    Route::resource('stages', StageController::class);
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
