# Laravel Snipcart API
This package makes it super easy to work with the Snipcart API in your Laravel application.

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
    | Set this to 'false' to authenticate using the 'live_secret'.
    | You probably want to do this in production only.
    |
    */

    'test_mode' => env('SNIPCART_TEST_MODE', true),

];
```

## Usage Example
Import the package at the top of your file. All of the following examples use the [Facade](https://laravel.com/docs/master/facades).

```php
use Aerni\SnipcartApi\Facades\SnipcartApi;
```

The `SnipcartApi` interface is made up of four parts. From defining the HTTP method to sending the request off to Snipcart.

```php
// 1. Set the HTTP method to be used for the API request.
SnipcartApi::get() ...

// 2. Call the main method for the request.
SnipcartApi::get()->product('product_id') ...

// 3. Add optional parameter methods.
SnipcartApi::get()->product('product_id')->limit(10)->offset(10) ...

// 4. Send the request off to Snipcart.
SnipcartApi::get()->product('product_id')->limit(10)->offset(10)->send();
```

This gets a Snipcart product by ID.

```php
$product = SnipcartApi::get()->product('product_id')->send();
```

All responses are wrapped in a [Laravel Collection](https://laravel.com/docs/master/collections) to make working with it super easy.

```php
$product->get('stock');
```

## Snipcart API Reference

### Products
[Snipcart API Reference on Products](https://docs.snipcart.com/v3/api-reference/products)

```php
// Get all products.
SnipcartApi::get()->products()->send();

// Post all products found on the URL.
SnipcartApi::post()->products('fetch_url')->send();

// Get a product by ID.
SnipcartApi::get()->product('product_id')->send();

// Update a product by ID. This requires additional parameter methods.
SnipcartApi::put()->product('product_id')->send();

// Delete a product by ID.
SnipcartApi::delete()->product('product_id')->send();
```

### Orders
[Snipcart API Reference on Orders](https://docs.snipcart.com/v3/api-reference/orders)

```php
// Get all orders.
SnipcartApi::get()->orders()->send();

// Get an order by token.
SnipcartApi::get()->order('order_token')->send();

// Update an order by token. This requires additional parameter methods.
SnipcartApi::put()->order('order_token')->send();
```

### Notifications
[Snipcart API Reference on Notifications](https://docs.snipcart.com/v3/api-reference/notifications)

```php
// Get all notifications of an order.
SnipcartApi::get()->notifications('order_token')->send();

// Post a notification to an order. This requires additional parameter methods.
SnipcartApi::post()->notification('order_token')->send();
```

### Refunds
[Snipcart API Reference on Refunds](https://docs.snipcart.com/v3/api-reference/refunds)

```php
// Get all refunds of an order.
SnipcartApi::get()->refunds('order_token')->send();

// Get a specific refund from an order.
SnipcartApi::get()->refund('order_token', 'refund_id')->send();

// Post a refund to an order. This requires additional parameter methods.
SnipcartApi::post()->refund('order_token')->send();
```

## Parameter Methods
Pass required or optional parameters to your requests using the fluent interface provided by this package. A common use case is to set a `limit` and `offset` to your request.

```php
SnipcartApi::get()->products()->limit(10)->offset(10)->send();
```

### Parameter Methods API Reference
Consult the [Snipcart API Reference Documentation](https://docs.snipcart.com/v3/api-reference/introduction) to check which parameters are available to what endpoint.

```php
// The maximum number of items returned by the request.
limit(int $limit);

// The number of items that will be skipped.
offset(int $offset);

// The product ID defined by the user.
userDefinedId(string $id);

// The product ID defined by the user.
productId(string $id);

// Filter products to return those that have been bought from specified date.
from(string $from);

// Filter products to return those that have been bought until specified date.
to(string $to);

// The URL where we will find product details.
fetchUrl(string $url);

// Specifies how inventory should be tracked for this product.
// Can be 'Single' or 'Variant.
// Variant can be used when a product has some dropdown custom fields.
inventoryManagementMethod(string $method);

// Allows to set stock per product variant.
variants(array $variants);

// The number of items in stock.
// Will be used when 'inventoryManagementMethod' is 'Single'.
stock(int $stock = null);

// If true a customer will be able to buy the product even if it's out of stock.
// The stock level might be negative.
// If false it will be impossible to buy the product.
allowOutOfStockPurchases(bool $bool)

// A status criteria for your order collection.
// Possible values: InProgress, Processed, Disputed, Shipped, Delivered, Pending, Cancelled
status(string $status)

// The order payment status.
// Possible values: Paid, Deferred, PaidDeferred, ChargedBack, Refunded, Paidout,
// Failed, Pending, Expired, Cancelled, Open, Authorized.
paymentStatus(string $status)

// The invoice number of the order to retrieve.
invoiceNumber(string $invoiceNumber)

// The name of the person who made the purchase.
placedBy(string $name)

// Returns only the orders that are recurring or not.
isRecurringOrder(bool $bool)

// The tracking number associated to the order.
trackingNumber(string $number)

// The URL where the customer will be able to track its order.
trackingUrl(string $url)

// A simple array that can hold any data associated to this order.
metadata(array $metadata)

// The type of notification.
// Possible values: Comment, OrderStatusChanged, OrderShipped, TrackingNumber, Invoice
type(string $type)

// The delivery method of the notification.
// Possible values: Email, None
deliveryMethod(string $method)

// The message of the notification.
// Possible values: Email, None
message(string $message)

// The amount of the refund.
amount(string $amount)

// The reason for the refund.
comment(string $comment)
```

## Tests
Run the tests like this:

```bash
vendor/bin/phpunit
```
