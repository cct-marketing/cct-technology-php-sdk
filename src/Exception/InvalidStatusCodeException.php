<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

final class InvalidStatusCodeException extends ApiRequestException
{
    public static function create(array $expectedCodes, int $actualCode, string $responseBody): self
    {
        return new self(
            sprintf('Expected "%d" but recieved "%d" with response body: %s', implode(' or ', $expectedCodes), $actualCode, $responseBody)
        );
    }
}
