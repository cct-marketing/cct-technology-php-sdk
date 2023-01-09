<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image\ImageDataFactory;

final class GoogleResponsiveAdVariantData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'short_headlines' => [
                    'This is a short headline',
                    'This is another short headline',
                ],
                'long_headline' => 'This is a long headline',
                'descriptions' => [
                    'This is a description',
                    'This is another description',
                ],
                'images' => [ImageDataFactory::dataWithOverride()],
            ],
            $data
        );
    }

    public static function createObject(array $data = []): GoogleResponsiveAdVariant
    {
        return GoogleResponsiveAdVariant::fromArray(self::dataWithOverride($data));
    }
}
