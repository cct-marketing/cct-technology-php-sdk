<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Response;

use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\CampaignFlow\Data\Category;
use CCT\SDK\CampaignFlow\Data\Pricing;
use CCT\SDK\CampaignFlow\Data\Settings;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;

final class CampaignFlowItem extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignFlowId::class)]
        public readonly CampaignFlowId $id,
        public readonly string $name,
        public readonly string $label,
        #[CastToCollectionObject(Pricing::class)]
        public readonly Pricing $pricing,
        public readonly Category $category,
        public readonly Settings $settings
    ) {
    }
}
