<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

final class InvalidStatusCodeException extends RequestException
{
    public static function create(int $expectedCode, int $actualCode, string $responseBody): self
    {
        return new self(
            sprintf('Expected "%d" but recieved "%d" with response body: %s', $expectedCode, $actualCode, $responseBody)
        );
    }
}
