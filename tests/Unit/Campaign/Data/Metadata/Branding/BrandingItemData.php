<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Branding;

use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingItem;

final class BrandingItemData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'key' => 'brand_colour',
                'value' => '#FF0000',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): BrandingItem
    {
        return BrandingItem::fromArray(self::dataWithOverride($data));
    }
}
