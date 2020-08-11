<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Your secret Snipcart API Keys.
    |
    */

    'live_secret' => env('SNIPCART_LIVE_SECRET'),
    'test_secret' => env('SNIPCART_TEST_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | Test Mode
    |--------------------------------------------------------------------------
    |
    | Set this to "false" to authenticate using the "live_secret".
    | You probably want to do this in production only.
    |
    */

    'test_mode' => env('SNIPCART_TEST_MODE', true),

];
