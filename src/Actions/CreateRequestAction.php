<?php

namespace Aerni\SnipcartApi\Actions;

use Aerni\SnipcartApi\Exceptions\SnipcartApiException;
use Aerni\SnipcartApi\Request;
use Aerni\SnipcartApi\PendingRequest;
use Illuminate\Support\Collection;

class CreateRequestAction
{
    /**
     * Execute the pending request and return the response from the Snipcart API.
     *
     * @param PendingRequest $pendingRequest
     * @return array
     * @throws SnipcartApiException
     */
    public function execute(PendingRequest $pendingRequest): array
    {
        $method = $pendingRequest->method;
        $endpoint = $pendingRequest->endpoint;

        $acceptedParameters = collect($pendingRequest->acceptedParameters);
        $requestedParameters = collect($pendingRequest->requestedParameters);
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
    private function createFinalParameters(Collection $acceptedParameters, Collection $requestedParameters): array
    {
        $intersectedRequestedParameters = $requestedParameters->intersectByKeys($acceptedParameters);

        return $acceptedParameters->merge($intersectedRequestedParameters)
            ->filter()
            ->toArray();
    }
}
