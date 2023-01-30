<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractInteger;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class NumberOfBedrooms extends AbstractInteger
{
    protected function guard(int $value): void
    {
        Assertion::between($value, 1, 1000, self::errorPropertyPath());
    }
}
