<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location;

final class LocationData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'address' => '123 Main St',
                'coordinate' => [
                    'latitude' => 37.4224764,
                    'longitude' => -122.0842499,
                ],
                'radius' => [
                    'radius' => 5,
                    'measurement_unit' => 'km',
                ],
                'type' => 'real_estate',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): Location
    {
        return Location::fromArray(self::dataWithOverride($data));
    }
}
