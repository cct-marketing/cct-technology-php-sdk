<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Targeting extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(Locations::class)]
        public readonly Locations $locations,
        public readonly IndustryAddress $industryAddress,
        public readonly PropertyInformation $propertyInformation
    ) {
    }
}
