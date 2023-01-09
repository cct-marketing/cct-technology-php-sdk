<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Targeting extends AbstractMulti
{
    public function __construct(
        public readonly Locations $locations,
        public readonly IndustryAddress $industryAddress,
        public readonly PropertyInformation $propertyInformation
    ) {
    }

    public function toArray(): array
    {
        return [
            'locations' => $this->locations->toArray(),
            'industry_address' => $this->industryAddress->toArray(),
            'property_information' => $this->propertyInformation->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'locations', self::errorPropertyPath());
        Assertion::keyExists($data, 'industry_address', self::errorPropertyPath());
        Assertion::keyExists($data, 'property_information', self::errorPropertyPath());

        return new self(
            Locations::fromArray($data['locations']),
            IndustryAddress::fromArray($data['industry_address']),
            PropertyInformation::fromArray($data['property_information'])
        );
    }
}
