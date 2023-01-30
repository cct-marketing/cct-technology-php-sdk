<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class LongHeadline extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 90, self::errorPropertyPath());
    }
}
