<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\MessagesRepository::class, \App\Repositories\MessagesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SaveMessageRepository::class, \App\Repositories\SaveMessageRepositoryEloquent::class);
        //:end-bindings:
    }
}
