<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class IndustryAddress extends AbstractMulti
{
    public function __construct(
        public readonly Address $address,
        public readonly ?Coordinate $coordinate,
        public readonly ?LocationType $type = LocationType::REAL_ESTATE,
    ) {
    }
}
