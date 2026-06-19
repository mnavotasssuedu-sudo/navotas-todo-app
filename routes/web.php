<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Authentication routes (created by Breeze)
require __DIR__.'/auth.php';

// Todo routes
Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
// Redirect "dashboard" to your Todo list
Route::get('/dashboard', function () {
    return redirect()->route('todos.index');
})->name('dashboard');