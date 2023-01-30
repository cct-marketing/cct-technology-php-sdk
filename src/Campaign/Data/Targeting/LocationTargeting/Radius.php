<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

/**
 * Facebook has limits on radius:
 * 1 - 50 Miles
 * 1 - 80 KM
 */
#[MapperSettings(serializePublicMethods: false)]
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
}
