<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;

final class PropertyDescription extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 30000, self::errorPropertyPath());
    }
}
