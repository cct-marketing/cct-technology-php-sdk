<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractInteger;

final class Vat extends AbstractInteger
{
    protected function guard(int $value): void
    {
        Assertion::between($value, 1, 100, self::errorPropertyPath());
    }
}
