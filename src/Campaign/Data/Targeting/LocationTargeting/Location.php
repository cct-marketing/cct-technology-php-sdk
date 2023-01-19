<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Location extends AbstractMulti
{
    public function __construct(
        public readonly string $address,
        public readonly Coordinate $coordinate,
        public readonly Radius $radius,
        public readonly ?LocationType $type = LocationType::DEFAULT
    ) {
    }
}
