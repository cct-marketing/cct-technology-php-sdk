<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class PropertyInformation extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(PropertyPrice::class)]
        public readonly ?PropertyPrice $propertyPrice,
        #[CastToSingleValueObject(PropertySize::class)]
        public readonly ?PropertySize $propertySize,
        #[CastToSingleValueObject(NumberOfBedrooms::class)]
        public readonly ?NumberOfBedrooms $numberOfBedrooms
    ) {
    }
}
