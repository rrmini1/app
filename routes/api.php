<?php

declare(strict_types=1);

use App\Http\Controllers\API\ProjectController;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects', ProjectController::class);
