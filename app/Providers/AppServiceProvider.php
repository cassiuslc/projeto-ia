<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\GPT4AllServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(GPT4AllServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
