<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskApiController::class, 'index']);
    Route::post('/tasks', [TaskApiController::class, 'store']);
    Route::get('/tasks/{id}', [TaskApiController::class, 'show']);
    Route::put('/tasks/{id}', [TaskApiController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskApiController::class, 'destroy']);
});
