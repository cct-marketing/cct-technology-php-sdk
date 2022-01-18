<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Exception;

final class InvalidStatusCodeException extends \RuntimeException
{
    public static function create(int $expectedCode, int $actualCode, string $responseBody): self
    {
        return new self(
            sprintf('Expected "%d" but recieved "%d" with response body: %s', $expectedCode, $actualCode, $responseBody)
        );
    }
}
