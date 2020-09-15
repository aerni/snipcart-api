<?php

namespace Aerni\SnipcartApi\Actions;

use Aerni\SnipcartApi\Exceptions\SnipcartApiException;
use Aerni\SnipcartApi\PendingRequest;
use Aerni\SnipcartApi\Request;
use Illuminate\Support\Collection;

class CreateRequestAction
{
    /**
     * Send the pending request and return the response from the Snipcart API.
     *
     * @param PendingRequest $pendingRequest
     * @return Collection
     * @throws SnipcartApiException
     */
    public function send(PendingRequest $pendingRequest): Collection
    {
        $method = $pendingRequest->method();
        $endpoint = $pendingRequest->endpoint();

        $acceptedParameters = collect($pendingRequest->acceptedParameters());
        $requestedParameters = collect($pendingRequest->requestedParameters());
        $finalParameters = $this->createFinalParameters($acceptedParameters, $requestedParameters);

        return resolve(Request::class)->$method($endpoint, $finalParameters);
    }

    /**
     * Merges the requested and accepted parameters and outputs the final parameters ready for the API call.
     *
     * @param Collection $acceptedParameters
     * @param Collection $requestedParameters
     * @return array
     */
    protected function createFinalParameters(Collection $acceptedParameters, Collection $requestedParameters): array
    {
        return $acceptedParameters->filter()
            ->merge($requestedParameters)
            ->toArray();
    }
}
