<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Response;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Data\CampaignState;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapFrom;

final class CampaignStateResponse extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignId::class)]
        #[MapFrom('uuid')]
        public readonly CampaignId $campaignId,
        public readonly CampaignState $state
    ) {
    }
}
