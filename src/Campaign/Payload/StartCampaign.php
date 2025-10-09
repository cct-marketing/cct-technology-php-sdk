<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\Campaign\Data\Metadata\Metadata;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class StartCampaign extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignFlowId::class)]
        public readonly CampaignFlowId $campaignFlowUuid,
        public readonly ?Metadata $metadata = null
    ) {
    }
}
