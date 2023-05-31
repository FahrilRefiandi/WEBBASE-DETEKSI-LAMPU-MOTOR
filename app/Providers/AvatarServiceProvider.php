<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AvatarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('avatar', function () {
            return new \App\Helpers\Avatar();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
