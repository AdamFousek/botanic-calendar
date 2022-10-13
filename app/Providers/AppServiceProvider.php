<?php

namespace App\Providers;

use App\Repositories\GroupRepositoryInterface;
use App\Repositories\Illuminate\GroupRepository;
use App\Repositories\Illuminate\ProjectRepository;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProjectRepositoryInterface::class => ProjectRepository::class,
        GroupRepositoryInterface::class => GroupRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
