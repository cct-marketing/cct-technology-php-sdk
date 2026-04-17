<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Branding;

use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingItems;

final class BrandingItemsData
{
    public static function dataWithOverride(array $data = []): array
    {
        if (empty($data)) {
            return [
                ['key' => 'brand_colour', 'value' => '#FF0000'],
                ['key' => 'text_colour', 'value' => '#000000'],
                ['key' => 'logo_url', 'value' => 'https://example.com/logo.png'],
            ];
        }

        return $data;
    }

    public static function createObject(array $data = []): BrandingItems
    {
        return BrandingItems::fromArray(self::dataWithOverride($data));
    }
}
