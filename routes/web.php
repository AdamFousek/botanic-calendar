<?php

use App\Http\Controllers\Experiment\ExperimentController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
        Route::get('/', 'index')->name('projects.index');
        Route::get('/create', 'create')->name('projects.create');
        Route::post('/create', 'store')->name('projects.store');
        Route::get('/{project}', 'show')->name('projects.show');
        Route::get('/{project}/edit', 'edit')->name('projects.edit');
        Route::post('/{project}/delete', 'destroy')->name('projects.delete');

        Route::controller(ExperimentController::class)->group(function () {
            Route::get('{project}/experiment/{experiment}', 'show')->name('projects.experiment.show');
            Route::get('{project}/experiment/{experiment}/settings', 'edit')->name('projects.experiment.edit');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('users');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
    });

    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups', 'index')->name('groups.index');
        Route::get('/groups/create', 'create')->name('groups.create');
        Route::get('/groups/{group}', 'show')->name('groups.show');
        Route::get('/groups/{group}/edit', 'edit')->name('groups.edit');
        Route::get('/groups/{group}/inviteMember/{invitation}', 'acceptInvitation')->name('groups.acceptInvitation');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search.index');
    });
});

require __DIR__.'/auth.php';
