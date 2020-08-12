<?php

namespace Aerni\SnipcartApi\Facades;

use Illuminate\Support\Facades\Facade;

class SnipcartApi extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'SnipcartApi';
    }
}
