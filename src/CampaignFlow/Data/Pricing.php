<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class Pricing extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return PricingItem::class;
    }
}
