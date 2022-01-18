<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Location extends AbstractValueObject
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var Coordinate
     */
    private $coordinate;

    /**
     * @var Radius
     */
    private $radius;

    /**
     * @var LocationType
     */
    private $type;

    /**
     * Location constructor.
     *
     * @param string       $address
     * @param Coordinate   $coordinate
     * @param Radius       $radius
     * @param LocationType $type
     */
    public function __construct(
        string $address,
        Coordinate $coordinate,
        Radius $radius,
        LocationType $type = null
    ) {
        $this->address = $address;
        $this->coordinate = $coordinate;
        $this->radius = $radius;
        $this->type = $type ?? LocationType::defaultType();
    }

    /**
     * @param ValueObjectInterface $valueObject
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
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    /**
     * @return Radius
     */
    public function getRadius(): Radius
    {
        return $this->radius;
    }

    /**
     * @return LocationType
     */
    public function getType(): LocationType
    {
        return $this->type;
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'address', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'coordinate', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'radius', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'type', null, self::errorPropertyPath());

        return new self(
            $data['address'],
            Coordinate::fromArray($data['coordinate']),
            Radius::fromArray($data['radius']),
            LocationType::fromString($data['type'])
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'address' => $this->address,
            'coordinate' => $this->coordinate->toArray(),
            'radius' => $this->radius->toArray(),
            'type' => $this->type->toString(),
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
