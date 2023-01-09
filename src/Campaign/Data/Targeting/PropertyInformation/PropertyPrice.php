<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastucture\ValueObject\AbstractInteger;

final class PropertyPrice extends AbstractInteger
{
    protected function guard(int $value): void
    {
    }
}
