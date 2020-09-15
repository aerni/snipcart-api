# Laravel Snipcart API
This package makes it super easy to setup and work with the Snipcart API in your Laravel application.

## Installation
Install the package using Composer.

```bash
composer require aerni/snipcart-api
```

Set your Snipcart `Live Secret` and `Test Secret` in your `.env`. You can find them in your [Snipcart Dashboard](https://app.snipcart.com/dashboard/account/credentials).

```env
SNIPCART_LIVE_SECRET=********************************
SNIPCART_TEST_SECRET=********************************
```

You may also publish the config of the package.

```bash
php artisan vendor:publish --provider="Aerni\SnipcartApi\SnipcartApiServiceProvider"
```

The following config will be published to `config/snipcart-api.php`.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snipcart API Keys
    |--------------------------------------------------------------------------
    |
    | Your secret Snipcart API Keys for the Live and Test Environment.
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
```

## Basic Usage
...

## Tests
Run the tests like this:

```bash
vendor/bin/phpunit
```
