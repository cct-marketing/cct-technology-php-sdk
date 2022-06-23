<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

/**
 * Facebook has limits on radius:
 * 1 - 50 Miles
 * 1 - 80 KM
 */
final class Radius extends AbstractValueObject
{
    public const MEASUREMENT_UNIT_MILE = 'mi';
    public const MEASUREMENT_UNIT_KM = 'km';

    /**
     * @var int
     */
    private $radius;

    /**
     * @var string mi or km
     */
    private $measurementUnit;

    /**
     * Radius constructor.
     */
    public function __construct(int $radius, string $measurementUnit)
    {
        $this->guard($radius, $measurementUnit);
        $this->radius = $radius;
        $this->measurementUnit = $measurementUnit;
    }

    public function guard(int $radius, string $measurement)
    {
        Assertion::inArray(
            $measurement,
            [self::MEASUREMENT_UNIT_KM, self::MEASUREMENT_UNIT_MILE],
            null,
            self::errorPropertyPath()
        );

        if ($measurement === self::MEASUREMENT_UNIT_MILE) {
            Assertion::between($radius, 1, 50, null, self::errorPropertyPath());

            return;
        }

        Assertion::between($radius, 1, 80, null, self::errorPropertyPath());
    }

    /**
     * @param ValueObjectInterface | Radius $valueObject
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
            'radius' => $this->radius,
            'measurement_unit' => $this->measurementUnit,
        ];
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'radius', null, 'radius');
        Assertion::keyExists($data, 'measurement_unit', null, 'radius');

        return new self(
            (int) $data['radius'],
            $data['measurement_unit']
        );
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }
}
