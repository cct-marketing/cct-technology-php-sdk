<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Generic;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class GenericItems extends AbstractCollection
{
    /**
     * @param GenericItem[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return GenericItem::class;
    }
}
