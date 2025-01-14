<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;

final class PropertyType extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 256, self::errorPropertyPath());
    }
}
