<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Data;

use CCT\SDK\Infrastucture\ValueObject\AbstractString;

final class Name extends AbstractString
{
    protected function guard(string $value): void
    {
    }
}
