<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {  Schema::defaultStringLength(191);//solved error https://laravel-news.com/laravel-5-4-key-too-long-error
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        \Auth0\Login\Contract\Auth0UserRepository::class,
        \Auth0\Login\Repository\Auth0UserRepository::class
      );
    }
}
