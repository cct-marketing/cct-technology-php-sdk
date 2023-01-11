<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

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

    /**
     * @return array|
     */
    public function toArray(): array
    {
        return [
            'street_number' => $this->streetNumber,
            'street_name' => $this->streetName,
            'neighborhood' => $this->neighborhood,
            'locality' => $this->locality,
            'region' => $this->region,
            'postal_code' => $this->postalCode,
            'country' => $this->country?->toArray(),
            'formatted_address' => $this->formattedAddress,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new self(
            $data['street_number'] ?? null,
            $data['street_name'] ?? null,
            $data['neighborhood'] ?? null,
            $data['locality'] ?? null,
            $data['region'] ?? null,
            $data['postal_code'] ?? null,
            isset($data['country']) ? Country::fromArray($data['country']) : null,
            $data['formatted_address'] ?? null
        );
    }
}
