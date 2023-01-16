<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress;

final class IndustryAddressData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'address' => [
                    'street_number' => '123',
                    'street_name' => 'Main Street',
                    'neighborhood' => '',
                    'locality' => 'San Francisco',
                    'region' => 'CA',
                    'postal_code' => '94105',
                    'country' => [
                        'name' => 'United States',
                        'code' => 'US',
                    ],
                    'formatted_address' => '123 Main Street, San Francisco, CA, 94105, United States',
                ],
                'type' => 'real_estate',
                'coordinate' => [
                    'latitude' => 37.7749,
                    'longitude' => 122.4194,
                ],
            ],
            $data
        );
    }

    public static function createObject(array $data = []): IndustryAddress
    {
        return IndustryAddress::fromArray(self::dataWithOverride($data));
    }
}
