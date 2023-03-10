<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class GoogleResponsiveAdVariants extends AbstractCollection
{
    /**
     * @param GoogleResponsiveAdVariant[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return GoogleResponsiveAdVariant::class;
    }
}
