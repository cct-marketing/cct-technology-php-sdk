<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapFrom;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CreateCampaign extends AbstractMulti
{
    public function __construct(
        #[MapFrom('campaign_flow_uuid')]
        #[CastToSingleValueObject(CampaignFlowId::class)]
        public readonly CampaignFlowId $campaignFlowId,
        public readonly Details $details,
        public readonly AdContent $adContent,
        public readonly Targeting $targeting
    ) {
    }
}
