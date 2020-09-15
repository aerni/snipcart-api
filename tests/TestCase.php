<?php

namespace Aerni\SnipcartApi\Tests;

use Aerni\SnipcartApi\SnipcartApiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SnipcartApiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('snipcart-api.live_secret', 'this-is-a-secret-live-key');
        $app['config']->set('snipcart-api.test_secret', 'this-is-a-secret-test-key');
    }
}
