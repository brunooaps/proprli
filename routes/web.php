<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BuildingController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])
    ->name('logout');


//Task routes
Route::get('tasks', [TaskController::class, 'index'])
    ->name('tasks.index')
    ->middleware('auth');

Route::get('taskCreate', [TaskController::class, 'create'])
    ->name('tasks.create')
    ->middleware(['auth', CheckRole::class . ':owner']);

Route::get('taskEdit/{id}', [TaskController::class, 'edit'])
    ->name('tasks.edit')
    ->middleware('auth');

Route::post('taskCreate', [TaskController::class, 'store'])
    ->name('tasks.store')
    ->middleware(['auth', CheckRole::class . ':owner']);

Route::post('taskDelete/{id}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy')
    ->middleware(['auth', CheckRole::class . ':owner']);

Route::put('taskUpdate/{id}', [TaskController::class, 'update'])
    ->name('tasks.update')
    ->middleware(['auth', CheckRole::class . ':owner']);


//Comment routes
Route::post('createComment', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware(['auth', CheckRole::class . ':owner']);


//Building routes
Route::get('/', [BuildingController::class, 'index'])
    ->name('buildings.index')
    ->middleware('auth');
