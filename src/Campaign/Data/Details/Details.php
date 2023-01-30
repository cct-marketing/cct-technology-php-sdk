<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Details extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CampaignTitle::class)]
        public readonly CampaignTitle $campaignTitle,
        public readonly CampaignPeriod $campaignPeriod,
        #[CastToSingleValueObject(LandingPage::class)]
        public readonly LandingPage $landingPage
    ) {
    }
}
