<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\SnipcartApiConfigRepository as ConfigRepository;
use Illuminate\Support\ServiceProvider;

class SnipcartApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Request::class, function () {
            return new Request((new ConfigRepository())->apiSecret());
        });

        $this->app->bind('SnipcartApi', SnipcartApi::class);

        $this->mergeConfigFrom(__DIR__.'/../config/snipcart-api.php', 'snipcart-api');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/snipcart-api.php' => config_path('snipcart-api.php'),
        ], 'config');
    }
}
