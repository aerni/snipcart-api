<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Exceptions\ApiSecretNotFoundException;

class SnipcartApiConfigRepository
{
    /**
     * Get the secret Snipcart API Key by mode.
     *
     * @return string
     */
    public function apiSecret(): string
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
