<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\CampaignPhase;

use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignPhases extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(Phases::class)]
        public readonly Phases $phases
    ) {
    }
}
