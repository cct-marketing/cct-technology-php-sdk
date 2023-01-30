<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class Locations extends AbstractCollection
{
    /**
     * @param Location[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return Location::class;
    }
}
