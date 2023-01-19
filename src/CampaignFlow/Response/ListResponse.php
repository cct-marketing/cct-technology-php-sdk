<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Response;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ListResponse extends AbstractCollection
{
    /**
     * @param CampaignFlowItem[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return CampaignFlowItem::class;
    }
}
