<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;

final class Currency extends AbstractString
{
    protected function guard(string $value): void
    {
        // ISO 4217 3 letter currency
        Assertion::maxLength($value, 3, self::errorPropertyPath());
    }
}
