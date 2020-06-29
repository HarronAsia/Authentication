<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,

        );
        $this->app->singleton(
            \App\Repositories\Event\EventRepositoryInterface::class,
            \App\Repositories\Event\EventRepository::class

        );
        $this->app->singleton(
            \App\Repositories\Content\ContentRepositoryInterface::class,
            \App\Repositories\Content\ContentRepository::class

        );
        $this->app->singleton(
            \App\Repositories\Admin\AdminRepositoryInterface::class,
            \App\Repositories\Admin\AdminRepository::class

        );
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
