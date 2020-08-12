<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\Contracts\CurrencyApiService::class, \App\Services\CurrencyApiService::class);
        $this->app->bind(\App\Services\EntityService\Contracts\CurrencyService::class, \App\Services\EntityService\CurrencyService::class);
    }
}
