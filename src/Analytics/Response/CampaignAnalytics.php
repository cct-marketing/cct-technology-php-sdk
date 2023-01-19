<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignAnalytics extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignId::class)]
        public readonly CampaignId $campaignId,
        public readonly string $orderCode,
        public readonly string $orderType,
        public readonly Customer $customer,
        public readonly Analytics $analytics,
        public readonly Period $period
    ) {
    }
}
