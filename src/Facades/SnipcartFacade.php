<?php

namespace Aerni\SnipcartApi\Facades;

use Aerni\SnipcartApi\Snipcart;
use Illuminate\Support\Facades\Facade;

class SnipcartFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return Snipcart::class;
    }
}
