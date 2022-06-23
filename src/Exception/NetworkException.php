<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Exception;

use Psr\Http\Client\NetworkExceptionInterface;
use RuntimeException;

final class NetworkException extends RuntimeException
{
    public static function createFrom(NetworkExceptionInterface $exception): self
    {
        return new self($exception->getMessage(), (int) $exception->getCode(), $exception);
    }
}
