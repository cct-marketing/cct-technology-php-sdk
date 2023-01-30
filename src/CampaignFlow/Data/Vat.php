<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractFloat;

final class Vat extends AbstractFloat
{
    protected function guard(float $value): void
    {
        Assertion::between($value, 1, 100, self::errorPropertyPath());
    }
}
