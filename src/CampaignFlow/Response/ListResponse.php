<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Response;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ListResponse extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return CampaignFlowItem::class;
    }
}
