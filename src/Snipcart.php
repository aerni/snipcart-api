<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Exceptions\MethodChainingException;

class Snipcart
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
     * @return PendingRequest
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
            'to' => null
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
     * @return PendingRequest
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
}
