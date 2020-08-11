<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Actions\CreateRequestAction;
use Aerni\SnipcartApi\Support\Validator;

class PendingRequest
{
    public $method;
    public $endpoint;
    public $acceptedParameters;

    public $requestedParameters;

    public function __construct(string $method, string $endpoint, array $acceptedParameters = [])
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->acceptedParameters = $acceptedParameters;
    }

    /**
     * The maximum number of items returned by the request.
     *
     * @param int $limit
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function limit(int $limit): self
    {
        $this->setRequestedParameter('limit', $limit);

        return $this;
    }

    /**
     * The number of items that will be skipped.
     *
     * @param int $offset
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function offset(int $offset): self
    {
        $this->setRequestedParameter('offset', $offset);

        return $this;
    }

    /**
     * Filter products to return those that have been bought from specified date.
     *
     * @param string $from
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function from(string $from): self
    {
        $this->setRequestedParameter('from', $from);

        return $this;
    }

    /**
     * Filter products to return those that have been bought until specified date.
     *
     * @param string $to
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function to(string $to): self
    {
        $this->setRequestedParameter('to', $to);

        return $this;
    }

    /**
     * The URL where we will find product details.
     *
     * @param string $url
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function fetchUrl(string $url): self
    {
        $this->setRequestedParameter('fetchUrl', $url);

        return $this;
    }

    /**
     * Specifies how inventory should be tracked for this product. 
     * Can be "Single" or "Variant". 
     * Variant can be used when a product has some dropdown custom fields.
     *
     * @param string $method
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function inventoryManagementMethod(string $method): self
    {
        $this->setRequestedParameter('inventoryManagementMethod', $method);

        return $this;
    }

    /**
     * Allows to set stock per product variant.
     *
     * @param array $variants
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function variants(array $variants): self
    {
        $this->setRequestedParameter('variants', $variants);

        return $this;
    }

    /**
     * The number of items in stock. 
     * Will be used when "inventoryManagementMethod" is "Single".
     *
     * @param int $stock
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function stock(int $stock): self
    {
        $this->setRequestedParameter('stock', $stock);

        return $this;
    }
    
    /**
     * If true a customer will be able to buy the product even if it's out of stock. 
     * The stock level might be negative. 
     * If false it will be impossible to buy the product.
     *
     * @param bool $bool
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function allowOutOfStockPurchases(bool $bool): self
    {
        $this->setRequestedParameter('allowOutOfStockPurchases', $bool);

        return $this;
    }

    /**
     * send the request. This is the final method and has to be called at the end of the method chain.
     *
     * @return array
     * @throws Exceptions\SnipcartApiException
     */
    public function send(): array
    {
        return resolve(CreateRequestAction::class)->send($this);
    }

    /**
     * Add the requested parameters to an array.
     *
     * @param string $requestedParameter
     * @param int|string|null $value
     * @throws Exceptions\ValidatorException
     */
    private function setRequestedParameter(string $requestedParameter, $value): void
    {
        Validator::validateRequestedParameter($requestedParameter, $this->acceptedParameters);

        $this->requestedParameters[$requestedParameter] = $value;
    }
}
