<?php

namespace Aerni\SnipcartApi;

use Aerni\SnipcartApi\Exceptions\SnipcartApiException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Request
{
    protected const API_URL = 'https://app.snipcart.com/api';

    protected $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
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
     * @return array|mixed
     */
    protected function send(string $method, string $url, array $parameters = [])
    {
        try {
            return Http::withHeaders(['Accept' => 'application/json'])
                ->withBasicAuth($this->apiKey . ':', '')
                ->$method($url, $parameters)
                ->throw()
                ->json();
        } catch (RequestException $e) {
            $response = $e->response->json();
            $status = $e->response->status();
            $message = $e->response->json()['message'];

            throw new SnipcartApiException($message, $status, $response);
        }
    }
}
