<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractString;

final class ShortHeadline extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 30, self::errorPropertyPath());
    }
}
