<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

final class SerializationErrorException extends \InvalidArgumentException implements ApiExceptionInterface
{
    public static function createFrom(\Throwable $exception): self
    {
        return new self($exception->getMessage(), (int) $exception->getCode(), $exception);
    }
}
