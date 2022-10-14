<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::controller(ProjectController::class)->group(function() {
        Route::get('/projects', 'myProjects')->name('projects.index');
        Route::get('/project/create', 'create')->name('projects.create');
        Route::post('/project/create', 'store')->name('projects.store');
        Route::get('/project/{project}', 'show')->name('projects.show');
        Route::get('/project/{project}/edit', 'edit')->name('projects.edit');
        Route::post('/projects/{project}/edit', 'update')->name('projects.update');

        Route::get('/projects-all', 'allProjects')->name('allProjects.index');
        Route::get('/projects-all/{project}', 'show')->name('allProjects.show');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'index')->name('users');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::post('/user/{user}/edit', 'update')->name('user.update');
    });

    Route::controller(GroupController::class)->group(function() {
        Route::get('/groups', 'myGroups')->name('groups.index');
        Route::get('/groups/{group}', 'show')->name('groups.show');
        Route::get('/groups/create', 'create')->name('groups.create');
        Route::post('/groups/create', 'create')->name('groups.store');
    });
});

require __DIR__.'/auth.php';
