<?php

namespace Aerni\SnipcartApi;

class Snipcart
{
    /**
     * Get all Snipcart products.
     *
     * @return PendingRequest
     */
    public function getProducts(): PendingRequest
    {
        $method = 'get';
        $endpoint = '/products/';

        $acceptedParameters = [
            'limit' => null,
            'offset' => null,
            'from' => null,
            'to' => null
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Get a Snipcart product by its ID.
     *
     * @param string $id
     * @return PendingRequest
     */
    public function getProduct(string $id): PendingRequest
    {
        $method = 'get';
        $endpoint = '/products/'.$id;

        return new PendingRequest($method, $endpoint);
    }

    /**
     * Post Snipcart products found on a URL.
     *
     * @param string $url
     * @return PendingRequest
     */
    public function postProducts(string $url): PendingRequest
    {
        $method = 'post';
        $endpoint = '/products/';
        
        $acceptedParameters = [
            'fetchUrl' => $url,
        ];

        return new PendingRequest($method, $endpoint, $acceptedParameters);
    }

    /**
     * Update a Snipcart products by its ID.
     *
     * @param string $id
     * @return PendingRequest
     */
    public function updateProduct(string $id): PendingRequest
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
    public function deleteProduct(string $id): PendingRequest
    {
        $method = 'delete';
        $endpoint = '/products/'.$id;

        return new PendingRequest($method, $endpoint);
    }
}
