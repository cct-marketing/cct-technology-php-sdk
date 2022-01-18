<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

use function implode;

/**
 * https://google-developers.appspot.com/maps/documentation/javascript/examples/full/places-autocomplete-addressform
 */
final class Address extends AbstractValueObject
{
    /**
     * The format address can be different from concatenated data
     *
     * @var string
     */
    private $formattedAddress;

    /**
     * @var string | null
     */
    private $streetNumber;

    /**
     * The main address
     *
     * @var string | null
     */
    private $streetName;

    /**
     * neighborhood
     *
     * @var string | null
     */
    private $neighborhood;

    /**
     * City or locality
     *
     * @var string | null
     */
    private $locality;

    /**
     * Region or state or postal town
     *
     * @var string | null
     */
    private $region;

    /**
     * @var string | null
     */
    private $postalCode;

    /**
     * @var Country | null
     */
    private $country;

    /**
     * Address constructor.
     *
     * @param string|null  $streetNumber
     * @param string|null  $streetName
     * @param string|null  $neighborhood
     * @param string|null  $locality
     * @param string|null  $region
     * @param string|null  $postalCode
     * @param Country|null $country
     * @param string|null  $formattedAddress
     */
    public function __construct(
        string $streetNumber = null,
        string $streetName = null,
        string $neighborhood = null,
        string $locality = null,
        string $region = null,
        string $postalCode = null,
        Country $country = null,
        string $formattedAddress = null
    ) {
        $this->streetNumber = $streetNumber;
        $this->streetName = $streetName;
        $this->neighborhood = $neighborhood;
        $this->locality = $locality;
        $this->region = $region;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->formattedAddress = $formattedAddress ?? (string) $this;
    }

    /**
     * Returns a string representation of the Address in US standard format.
     *
     * @return string
     */
    public function __toString()
    {
        $address = [''];

        $this->streetNumber === null ?: $address[0] .= $this->streetNumber . ' ';
        $this->streetName === null ?: $address[0] .= $this->streetName;
        $this->neighborhood === null ?: $address[] = $this->neighborhood;
        $this->locality === null ?: $address[] = $this->locality;
        $this->region === null ?: $address[] = $this->region;
        $this->postalCode === null ?: $address[] = $this->postalCode;
        $this->country === null ?: $address[] = $this->country->getName();

        return implode(', ', $address);
    }

    /**
     * @param ValueObjectInterface | Address $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @return string | null
     */
    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    /**
     * @return string | null
     */
    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    /**
     * @return string | null
     */
    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    /**
     * @return string | null
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @return string | null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string | null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @return Country | null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return $this->formattedAddress;
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
            'country' => $this->country === null ? null : $this->country->toArray(),
            'formatted_address' => $this->formattedAddress,
        ];
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
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
