<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::controller(ProjectController::class)->group(function() {
        Route::get('/projects', 'index')->name('projects.index');
        Route::post('/projects/create', 'store')->name('projects.store');
        Route::get('/projects/create', 'create')->name('projects.create');
        Route::get('/projects/{project}', 'show')->name('projects.show');
        Route::get('/projects/{project}/edit', 'edit')->name('projects.edit');
        Route::post('/projects/{project}/edit', 'update')->name('projects.update');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'index')->name('users');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::post('/user/{user}/edit', 'update')->name('user.update');
    });
});

require __DIR__.'/auth.php';
