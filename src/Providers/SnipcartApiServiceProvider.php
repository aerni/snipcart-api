<?php

namespace Aerni\SnipcartApi\Providers;

use Aerni\SnipcartApi\Exceptions\ApiKeyNotFoundException;
use Aerni\SnipcartApi\Request;
use Illuminate\Support\ServiceProvider;

class SnipcartApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Request::class, function () {
            return new Request($this->apiKey());
        });
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/laravel-snipcart.php', 'laravel-snipcart');

        $this->publishes([
            __DIR__.'/../../config/laravel-snipcart.php' => config_path('laravel-snipcart.php'),
        ]);
    }

    /**
     * Returns the secret Snipcart API Key.
     *
     * @return string|mixed
     */
    protected function apiKey()
    {
        $mode = config('laravel-snipcart.test_mode');
        
        $apiKey = $mode
            ? config('laravel-snipcart.test_secret')
            : config('laravel-snipcart.live_secret');

        if (! $apiKey) {
            throw new ApiKeyNotFoundException($mode);
        }

        return $apiKey;
    }
}
