<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;

final class PropertyArea extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 100, self::errorPropertyPath());
    }
}
