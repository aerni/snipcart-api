<?php

namespace Aerni\SnipcartApi\Providers;

use Aerni\SnipcartApi\Exceptions\ApiSecretNotFoundException;
use Aerni\SnipcartApi\Request;
use Aerni\SnipcartApi\SnipcartApi;
use Illuminate\Support\ServiceProvider;

class SnipcartApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Request::class, function () {
            return new Request($this->apiSecret());
        });

        $this->app->bind('SnipcartApi', SnipcartApi::class);

        $this->mergeConfigFrom(__DIR__.'/../../config/snipcart-api.php', 'snipcart-api');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/snipcart-api.php' => config_path('snipcart-api.php'),
        ]);
    }

    /**
     * Returns the secret Snipcart API Key.
     *
     * @return string
     */
    protected function apiSecret()
    {
        $mode = config('snipcart-api.test_mode');

        $apiSecret = $mode
            ? config('snipcart-api.test_secret')
            : config('snipcart-api.live_secret');

        if (! $apiSecret) {
            throw new ApiSecretNotFoundException($mode);
        }

        return $apiSecret;
    }
}
