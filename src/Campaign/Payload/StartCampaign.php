<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class StartCampaign extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignFlowId::class)]
        public readonly CampaignFlowId $campaignFlowUuid
    ) {
    }
}
