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
        $this->mergeConfigFrom(__DIR__.'/../../config/snipcart-api.php', 'snipcart-api');

        $this->publishes([
            __DIR__.'/../../config/snipcart-api.php' => config_path('snipcart-api.php'),
        ]);
    }

    /**
     * Returns the secret Snipcart API Key.
     *
     * @return string|mixed
     */
    protected function apiKey()
    {
        $mode = config('snipcart-api.test_mode');
        
        $apiKey = $mode
            ? config('snipcart-api.test_secret')
            : config('snipcart-api.live_secret');

        if (! $apiKey) {
            throw new ApiKeyNotFoundException($mode);
        }

        return $apiKey;
    }
}
