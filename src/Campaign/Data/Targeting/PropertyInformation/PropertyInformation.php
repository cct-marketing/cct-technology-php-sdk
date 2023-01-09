<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class PropertyInformation extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        return new self(
            isset($data['property_price']) ? PropertyPrice::fromInt($data['property_price']) : null,
            isset($data['property_size']) ? PropertySize::fromInt($data['property_size']) : null,
            isset($data['number_of_bedrooms']) ? NumberOfBedrooms::fromInt($data['number_of_bedrooms']) : null
        );
    }

    public function __construct(
        public readonly ?PropertyPrice $propertyPrice,
        public readonly ?PropertySize $propertySize,
        public readonly ?NumberOfBedrooms $numberOfBedrooms
    ) {
    }

    public function toArray(): array
    {
        return [
            'property_price' => $this->propertyPrice?->toInt(),
            'property_size' => $this->propertySize?->toInt(),
            'number_of_bedrooms' => $this->numberOfBedrooms?->toInt(),
        ];
    }
}
