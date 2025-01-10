<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;

final class PropertyInformationData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'property_price' => 123456,
                'property_size' => 7890,
                'number_of_bedrooms' => 3,
                'property_description' => 'Property description used to help create ad content texts',
                'property_type' => 'Property Type',
                'property_area' => 'Property Area',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): PropertyInformation
    {
        return PropertyInformation::fromArray(self::dataWithOverride($data));
    }
}
