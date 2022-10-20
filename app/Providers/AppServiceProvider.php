<?php

namespace App\Providers;

use App\Repositories\GroupRepositoryInterface;
use App\Repositories\Illuminate\GroupRepository;
use App\Repositories\Illuminate\ProjectRepository;
use App\Repositories\Illuminate\UserRepository;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProjectRepositoryInterface::class => ProjectRepository::class,
        GroupRepositoryInterface::class => GroupRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
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
