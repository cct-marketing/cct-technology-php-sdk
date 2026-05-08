<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\CampaignPhase;

use CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType;
use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class Phases extends AbstractCollection
{
    public function __construct(
        #[CastListUnionToType(['open_house' => OpenHouse::class])]
        array $items
    ) {
        parent::__construct($items);
    }

    #[CastListUnionToType(['open_house' => OpenHouse::class])]
    public function items(): array
    {
        return $this->items;
    }

    public static function itemClassName(): string
    {
        return PhaseInterface::class;
    }
}
