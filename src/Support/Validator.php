<?php

namespace Aerni\SnipcartApi\Support;

use Aerni\SnipcartApi\Exceptions\ValidatorException;

class Validator
{
    /**
     * Validate the provided argument. Throw an error if the argument is not valid.
     *
     * @param string $key
     * @param $argument
     * @return string
     * @throws ValidatorException
     */
    public static function validateArgument(string $key, $argument): string
    {
        if (self::argumentIsValid($argument)) {
            return Normalizer::normalizeArgument($argument);
        } else {
            throw new ValidatorException("Please provide a string with comma-separated values or an array as the argument to the [{$key}] parameter.");
        }
    }

    /**
     * Validate the requested parameter. Throw an error if the parameter is not accepted.
     *
     * @param string $requestedParameter
     * @param $acceptedParameter
     * @return string
     * @throws ValidatorException
     */
    public static function validateRequestedParameter(string $requestedParameter, $acceptedParameter): string
    {
        if (self::requestedParameterIsAccepted($requestedParameter, $acceptedParameter)) {
            return Normalizer::normalizeArgument($requestedParameter);
        } else {
            $acceptedParameter = collect($acceptedParameter)->keys()->implode(', ');

            throw new ValidatorException("The parameter [{$requestedParameter}] can’t be used with this endpoint. Accepted parameters: [{$acceptedParameter}].");
        }
    }

    /**
     * Check if the provided argument is valid.
     *
     * @param $argument
     * @return bool
     */
    private static function argumentIsValid($argument): bool
    {
        if (! empty($argument) && is_array($argument)) {
            return true;
        }

        if (! empty($argument) && is_string($argument)) {
            return true;
        }

        return false;
    }

    /**
     * Check if the provided parameters is valid.
     *
     * @param $requestedParameter
     * @param $acceptedParameter
     * @return bool
     */
    private static function requestedParameterIsAccepted($requestedParameter, $acceptedParameter): bool
    {
        if (array_key_exists($requestedParameter, $acceptedParameter)) {
            return true;
        }

        return false;
    }
}
