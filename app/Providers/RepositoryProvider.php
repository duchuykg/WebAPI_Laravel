<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\UserTestRepository;
use App\Repositories\Contracts\IAuthRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\ICategoryRepository;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IUserRepository::class, UserTestRepository::class);
        $this->app->bind(IAuthRepository::class, AuthRepository::class);

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



