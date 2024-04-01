<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GPT4AllService;

class GPT4AllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GPT4AllService::class, function ($app) {
            return new GPT4AllService(env('gpt4all.api_key'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
