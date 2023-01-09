<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

use Psr\Http\Client\NetworkExceptionInterface;

final class NetworkException extends RequestException
{
    public static function createFrom(NetworkExceptionInterface $exception): self
    {
        return new self($exception->getMessage(), $exception->getCode(), $exception);
    }
}
