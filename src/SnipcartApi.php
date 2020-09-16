<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Exceptions\MethodChainingException;

class SnipcartApi
{
    protected $method;

    /**
     * Set the method to 'get';
     *
     * @return self
     */
    public function get(): self
    {
        $this->method = 'get';

        return $this;
    }

    /**
     * Set the method to 'post';
     *
     * @return self
     */
    public function post(): self
    {
        $this->method = 'post';

        return $this;
    }

    /**
     * Set the method to 'put';
     *
     * @return self
     */
    public function put(): self
    {
        $this->method = 'put';

        return $this;
    }

    /**
     * Set the method to 'delete';
     *
     * @return self
     */
    public function delete(): self
    {
        $this->method = 'delete';

        return $this;
    }

    /**
     * Get or post Snipcart products.
     *
     * @param string|null $url
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function products(string $url = null): PendingRequest
    {
        if ($this->method === 'get') {
            return $this->getProducts();
        }

        if ($this->method === 'post') {
            return $this->postProducts($url);
        }

        throw new MethodChainingException($this->method, 'products');
    }

    /**
     * Get all Snipcart products.
     *
     * @return PendingRequest
     */
    protected function getProducts(): PendingRequest
    {
        $method = 'get';
        $endpoint = '/products/';

        $acceptedParameters = [
            'limit' => null,
            'offset' => null,
            'userDefinedId' => null,
            'from' => null,
            'to' => null,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Post Snipcart products found on a URL.
     *
     * @param string $url
     * @return PendingRequest
     */
    protected function postProducts(string $url): PendingRequest
    {
        $method = 'post';
        $endpoint = '/products/';

        $acceptedParameters = [
            'fetchUrl' => $url,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Get, post or put a Snipcart product.
     *
     * @param string $id
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function product(string $id): PendingRequest
    {
        if ($this->method === 'get') {
            return $this->getProduct($id);
        }

        if ($this->method === 'put') {
            return $this->putProduct($id);
        }

        if ($this->method === 'delete') {
            return $this->deleteProduct($id);
        }

        throw new MethodChainingException($this->method, 'product');
    }

    /**
     * Get a Snipcart product by its ID.
     *
     * @param string $id
     * @return PendingRequest
     */
    protected function getProduct(string $id): PendingRequest
    {
        $method = 'get';
        $endpoint = '/products/'.$id;

        return new PendingRequest($method, $endpoint);
    }

    /**
     * Update a Snipcart products by its ID.
     *
     * @param string $id
     * @return PendingRequest
     */
    protected function putProduct(string $id): PendingRequest
    {
        $method = 'put';
        $endpoint = '/products/'.$id;

        $acceptedParameters = [
            'inventoryManagementMethod' => null,
            'variants' => null,
            'stock' => null,
            'allowOutOfStockPurchases' => null,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Delete a Snipcart products by its ID.
     *
     * @param string $id
     * @return PendingRequest
     */
    protected function deleteProduct(string $id): PendingRequest
    {
        $method = 'delete';
        $endpoint = '/products/'.$id;

        return new PendingRequest($method, $endpoint);
    }

    /**
     * Get Snipcart orders.
     *
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function orders(): PendingRequest
    {
        if ($this->method === 'get') {
            return $this->getOrders();
        }

        throw new MethodChainingException($this->method, 'orders');
    }

    /**
     * Get all Snipcart orders.
     *
     * @return PendingRequest
     */
    protected function getOrders(): PendingRequest
    {
        $method = 'get';
        $endpoint = '/orders/';

        $acceptedParameters = [
            'limit' => null,
            'offset' => null,
            'status' => null,
            'invoiceNumber' => null,
            'productId' => null,
            'placedBy' => null,
            'from' => null,
            'to' => null,
            'isRecurringOrder' => null,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Get, post or put a Snipcart order.
     *
     * @param string $token
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function order(string $token): PendingRequest
    {
        if ($this->method === 'get') {
            return $this->getOrder($token);
        }

        if ($this->method === 'put') {
            return $this->putOrder($token);
        }

        throw new MethodChainingException($this->method, 'order');
    }

    /**
     * Get a Snipcart order by its token.
     *
     * @param string $token
     * @return PendingRequest
     */
    protected function getOrder(string $token): PendingRequest
    {
        $method = 'get';
        $endpoint = '/orders/'.$token;

        return new PendingRequest($method, $endpoint);
    }

    /**
     * Update a Snipcart order by its token.
     *
     * @param string $token
     * @return PendingRequest
     */
    protected function putOrder(string $token): PendingRequest
    {
        $method = 'put';
        $endpoint = '/orders/'.$token;

        $acceptedParameters = [
            'status' => null,
            'paymentStatus' => null,
            'trackingNumber' => null,
            'trackingUrl' => null,
            'metadata' => null,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Get Snipcart order notifications.
     *
     * @param string $token
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function notifications(string $token): PendingRequest
    {
        if ($this->method === 'get') {
            return $this->getNotifications($token);
        }

        throw new MethodChainingException($this->method, 'notifications');
    }

    /**
     * Get Snipcart order notifications.
     *
     * @param string $token
     * @return PendingRequest
     */
    protected function getNotifications(string $token): PendingRequest
    {
        $method = 'get';
        $endpoint = '/orders/'.$token.'/notifications/';

        return new PendingRequest($method, $endpoint);
    }

    /**
     * Post a Snipcart order notification.
     *
     * @param string $token
     * @return PendingRequest
     * @throws MethodChainingException
     */
    public function notification(string $token): PendingRequest
    {
        if ($this->method === 'post') {
            return $this->postNotification($token);
        }

        throw new MethodChainingException($this->method, 'notification');
    }

    /**
     * Post a Snipcart order notification.
     *
     * @param string $token
     * @return PendingRequest
     */
    protected function postNotification(string $token): PendingRequest
    {
        $method = 'post';
        $endpoint = '/orders/'.$token.'/notifications/';

        $acceptedParameters = [
            'type' => null,
            'deliveryMethod' => null,
            'message' => null,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }
}
