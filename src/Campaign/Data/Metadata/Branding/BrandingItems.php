<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Branding;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class BrandingItems extends AbstractCollection
{
    /**
     * @param BrandingItem[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return BrandingItem::class;
    }
}
