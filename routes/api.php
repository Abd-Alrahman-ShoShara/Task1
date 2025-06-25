<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

// Auth routes (no authentication needed)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::get('/categories', action: [CategoriesController::class,'allCategories']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/tasks', [TaskController::class, 'index']);

    // Tasks

    Route::post('/addtasks', [TaskController::class, 'store']);

    Route::put('/updateTasks/{task}', [TaskController::class, 'update']);

    Route::delete('/deleteTasks/{task}', [TaskController::class, 'destroy']);
});
