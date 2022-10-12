<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::resource('projects', ProjectController::class);

    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'index')->name('users');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::post('/user/{user}/edit', 'update')->name('user.update');
    });
});

require __DIR__.'/auth.php';
