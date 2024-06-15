<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

//Task routes
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('taskCreate', [TaskController::class, 'create'])->name('tasks.create');
Route::get('taskEdit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::post('taskDelete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

//Comment routes
Route::post('createComment', [CommentController::class, 'create'])->name('comments.store');