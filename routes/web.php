<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::put('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.status');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

require __DIR__ . '/auth.php';
