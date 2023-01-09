<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

/**
 * Facebook has limits on radius:
 * 1 - 50 Miles
 * 1 - 80 KM
 */
final class Radius extends AbstractMulti
{
    public const MEASUREMENT_UNIT_MILE = 'mi';
    public const MEASUREMENT_UNIT_KM = 'km';

    /**
     * Radius constructor.
     */
    public function __construct(public readonly int $radius, public readonly MeasurementUnit $measurementUnit)
    {
        $this->guard($radius, $measurementUnit);
    }

    public function guard(int $radius, MeasurementUnit $measurement): void
    {
        if (MeasurementUnit::MILE === $measurement) {
            Assertion::between($radius, 1, 50, self::errorPropertyPath());

            return;
        }

        Assertion::between($radius, 1, 80, self::errorPropertyPath());
    }

    public function toArray(): array
    {
        return [
            'radius' => $this->radius,
            'measurement_unit' => $this->measurementUnit->value,
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'radius', self::errorPropertyPath());
        Assertion::keyExists($data, 'measurement_unit', self::errorPropertyPath());

        return new self(
            (int) $data['radius'],
            MeasurementUnit::from($data['measurement_unit'])
        );
    }
}
