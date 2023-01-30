<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Address extends AbstractMulti
{
    public function __construct(
        public readonly ?string $streetNumber = null,
        public readonly ?string $streetName = null,
        public readonly ?string $neighborhood = null,
        public readonly ?string $locality = null,
        public readonly ?string $region = null,
        public readonly ?string $postalCode = null,
        public readonly ?Country $country = null,
        public readonly ?string $formattedAddress = null,
    ) {
    }

    /**
     * Returns a string representation of the Address in US standard format.
     */
    public function toString(): string
    {
        $address = [''];

        $this->streetNumber === null ?: $address[0] .= $this->streetNumber . ' ';
        $this->streetName === null ?: $address[0] .= $this->streetName;
        $this->neighborhood === null ?: $address[] = $this->neighborhood;
        $this->locality === null ?: $address[] = $this->locality;
        $this->region === null ?: $address[] = $this->region;
        $this->postalCode === null ?: $address[] = $this->postalCode;
        $this->country === null ?: $address[] = $this->country->name;

        return \implode(', ', $address);
    }
}
