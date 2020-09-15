<?php

namespace Aerni\SnipcartApi\Tests;

use Aerni\SnipcartApi\SnipcartApiConfigRepository as ConfigRepository;

class SnipcartApiConfigTest extends TestCase
{
    /** @test */
    public function it_can_get_the_test_secret()
    {
        $testSecret = (new ConfigRepository())->apiSecret();

        $this->assertEquals($testSecret, config('snipcart-api.test_secret'));
    }

    /** @test */
    public function it_can_get_the_live_secret()
    {
        config()->set('snipcart-api.test_mode', false);

        $liveSecret = (new ConfigRepository())->apiSecret();

        $this->assertEquals($liveSecret, config('snipcart-api.live_secret'));
    }
}
