<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use CCT\SDK\Infrastucture\Assert\Assertion;

abstract class AbstractUrl extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::url($value, static::errorPropertyPath());
        Assertion::maxLength($value, 2048, static::errorPropertyPath());
    }
}
