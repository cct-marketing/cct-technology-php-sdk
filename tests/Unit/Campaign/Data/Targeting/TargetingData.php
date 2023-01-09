<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting;

use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting\IndustryAddressData;
use CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting\LocationData;
use CCT\SDK\Tests\Unit\Campaign\Data\Targeting\PropertyInformation\PropertyInformationData;

final class TargetingData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'locations' => [LocationData::dataWithOverride()],
                'industry_address' => IndustryAddressData::dataWithOverride(),
                'property_information' => PropertyInformationData::dataWithOverride(),
            ],
            $data
        );
    }

    public static function createObject(array $data = []): PropertyInformation
    {
        return PropertyInformation::fromArray(self::dataWithOverride($data));
    }
}
