<?php

use App\Http\Controllers\Experiment\ExperimentController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Livewire\Dashboard\Index::class)->name('dashboard');

    Route::prefix('/projects')->group(function () {
        Route::get('/', Livewire\Project\Pages\Index::class)->name('projects.index');
        Route::get('/create', Livewire\Project\Pages\Create::class)->name('projects.create');
        Route::get('/{project}', Livewire\Project\Pages\Show::class)->name('projects.show');
        Route::get('/{project}/edit', Livewire\Project\Pages\Edit::class)->name('projects.edit');
    });

    Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
        Route::controller(ExperimentController::class)->group(function () {
            Route::get('{project}/experiment/{experiment}', 'show')->name('projects.experiment.show');
            Route::get('{project}/experiment/{experiment}/settings', 'edit')->name('projects.experiment.edit');
        });
    });

    // User
    Route::prefix('/user')->group(function () {
        Route::get('/{user}', Livewire\User\Pages\Show::class)->name('user.show');
        Route::get('/{user}/edit', Livewire\User\Pages\Edit::class)->name('user.edit');
    });

    // Groups
    Route::prefix('/groups')->group(function () {
        Route::get('/', Livewire\Group\Pages\Index::class)->name('groups.index');
        Route::get('/create', Livewire\Group\Pages\Create::class)->name('groups.create');
        Route::get('/{group}', Livewire\Group\Pages\Show::class)->name('groups.show');
        Route::get('/{group}/edit', Livewire\Group\Pages\Edit::class)->name('groups.edit');
        Route::get('/{group}/inviteMember/{invitation}', Livewire\Group\Actions\AcceptInvitation::class)->name('groups.acceptInvitation');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search.index');
    });
});

require __DIR__.'/auth.php';
