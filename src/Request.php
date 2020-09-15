<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Exceptions\SnipcartApiException;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Request
{
    protected const API_URL = 'https://app.snipcart.com/api';

    protected $apiSecret;

    public function __construct(string $apiSecret)
    {
        $this->apiSecret = $apiSecret;
    }

    /**
     * Make a GET request.
     *
     * @param string $endpoint
     * @param array $parameters
     * @return array|mixed
     */
    public function get(string $endpoint, array $parameters = [])
    {
        return $this->send('get', Self::API_URL . $endpoint, $parameters);
    }

    /**
     * Make a POST request.
     *
     * @param string $endpoint
     * @param array $parameters
     * @return array|mixed
     */
    public function post(string $endpoint, array $parameters = [])
    {
        return $this->send('post', Self::API_URL . $endpoint, $parameters);
    }

    /**
     * Make a PUT request.
     *
     * @param string $endpoint
     * @param array $parameters
     * @return array|mixed
     */
    public function put(string $endpoint, array $parameters = [])
    {
        return $this->send('put', Self::API_URL . $endpoint, $parameters);
    }

    /**
     * Make a DELETE request.
     *
     * @param string $endpoint
     * @param array $parameters
     * @return array|mixed
     */
    public function delete(string $endpoint, array $parameters = [])
    {
        return $this->send('delete', Self::API_URL . $endpoint, $parameters);
    }

    /**
     * Send a request to the Snipcart API.
     *
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @return Collection
     */
    protected function send(string $method, string $url, array $parameters = []): Collection
    {
        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->withBasicAuth($this->apiSecret . ':', '')
                ->$method($url, $parameters)
                ->throw()
                ->json();

            return collect($response);
        } catch (RequestException $e) {
            $message = $e->response->json()['message'] ?? $e->getMessage();
            $status = $e->response->status() ?? $e->getCode();
            $response = $e->response->json();

            throw new SnipcartApiException($message, $status, $response);
        }
    }
}
