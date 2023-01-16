<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Client\ClientExceptionInterface;

class ApiRequestException extends \RuntimeException implements ApiExceptionInterface
{
    public static function createFrom(ClientExceptionInterface $exception): ApiExceptionInterface
    {
        if ($exception instanceof BadResponseException) {
            return new BadApiRequestException($exception->getMessage(), $exception->getRequest(), $exception->getResponse(), $exception);
        }

        return new self($exception->getMessage(), $exception->getCode(), $exception);
    }
}
