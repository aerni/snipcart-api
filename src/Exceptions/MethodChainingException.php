<?php

namespace Aerni\SnipcartApi\Exceptions;

use Exception;
use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;

class MethodChainingException extends Exception implements ProvidesSolution
{
    protected $httpMethod;
    protected $method;

    public function __construct($httpMethod, $method)
    {
        parent::__construct("Method chaining error.");

        $this->httpMethod = $httpMethod;
        $this->method = $method;
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create("Can't use [{$this->method}] method after [{$this->httpMethod}] method.")
            ->setSolutionDescription("Make sure to use an HTTP method that works with the [{$this->method}] method.")
            ->setDocumentationLinks([
                'Read the docs' => 'https://github.com/aerni/laravel-snipcart-api',
            ]);
    }
}
