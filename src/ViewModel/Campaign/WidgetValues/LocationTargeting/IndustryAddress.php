<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class IndustryAddress extends AbstractValueObject
{
    /**
     * @var Address;
     */
    private $address;

    /**
     * @var Coordinate | null
     */
    private $coordinate;

    /**
     * @var LocationType
     */
    private $type;

    /**
     * IndustryAddress constructor.
     */
    public function __construct(Address $address, LocationType $type, ?Coordinate $coordinate = null)
    {
        $this->address = $address;
        $this->coordinate = $coordinate;
        $this->type = $type;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return Coordinate | null
     */
    public function getCoordinate(): ?Coordinate
    {
        return $this->coordinate;
    }

    public function getType(): LocationType
    {
        return $this->type;
    }

    /**
     * @param ValueObjectInterface|IndustryAddress $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * Serialize object into an array or string
     */
    public function toArray(): array
    {
        return [
            'address' => $this->address->toArray(),
            'type' => $this->type->toString(),
            'coordinate' => $this->coordinate !== null ? $this->coordinate->toArray() : null,
        ];
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'address', null, 'industry_address');
        Assertion::keyExists($data, 'type', null, 'industry_address');

        return new self(
            Address::fromArray($data['address']),
            LocationType::fromString($data['type']),
            isset($data['coordinate']) ? Coordinate::fromArray($data['coordinate']) : null
        );
    }
}