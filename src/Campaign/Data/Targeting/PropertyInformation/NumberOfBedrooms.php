<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractInteger;

final class NumberOfBedrooms extends AbstractInteger
{
    protected function guard(int $value): void
    {
        Assertion::between($value, 1, 1000, self::errorPropertyPath());
    }
}
