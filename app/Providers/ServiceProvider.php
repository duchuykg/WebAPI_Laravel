<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\Contracts\IAuthService;

use App\Services\Contracts\IUserService;
use App\Services\Contracts\ICategoryService;
use Illuminate\Support\ServiceProvider as AppServiceProvider;

class ServiceProvider extends AppServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAuthService::class, AuthService::class);

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
