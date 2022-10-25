<?php

use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index')->name('projects.index');
        Route::get('/projects/create', 'create')->name('projects.create');
        Route::post('/projects/create', 'store')->name('projects.store');
        Route::get('/projects/{project}', 'show')->name('projects.show');
        Route::get('/projects/{project}/edit', 'edit')->name('projects.edit');
        Route::post('/projects/{project}/edit', 'update')->name('projects.update');
        Route::post('/projects/{project}/delete', 'destroy')->name('projects.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('users');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::post('/user/{user}/edit', 'update')->name('user.update');
    });

    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups', 'index')->name('groups.index');
        Route::get('/groups/create', 'create')->name('groups.create');
        Route::post('/groups/inviteMember/{group}', 'inviteMember')->name('groups.inviteMember');
        Route::get('/groups/{group}', 'show')->name('groups.show');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search.index');
    });
});

require __DIR__.'/auth.php';
