<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class Pricing extends AbstractCollection
{
    /**
     * @param PricingItem[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return PricingItem::class;
    }
}
