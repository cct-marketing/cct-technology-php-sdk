<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Exception;

use CCT\SDK\Exception\RequestException;

final class InvalidRequestTypeException extends RequestException
{
    public static function create(string $type, array $allowedTypes): self
    {
        return new self(
            sprintf(
                'Invalid type "%s". You must have a type key with one of the following values "%s"',
                $type,
                implode(', ', $allowedTypes)
            )
        );
    }
}
