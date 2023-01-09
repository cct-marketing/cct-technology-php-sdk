<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class Locations extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return Location::class;
    }
}
