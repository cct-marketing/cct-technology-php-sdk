<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractString;

final class CampaignTitle extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 120, null, self::errorPropertyPath());
    }
}
