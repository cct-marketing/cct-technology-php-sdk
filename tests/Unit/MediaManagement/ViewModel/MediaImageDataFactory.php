<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\MediaManagement\ViewModel;

use CCT\SDK\MediaManagement\ViewModel\MediaImage;

final class MediaImageDataFactory
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            BaseMediaDataFactory::dataWithOverride(),
            [
                'content_size' => 100,
                'width' => 200,
                'height' => 300,
            ],
            $data
        );
    }

    public static function createObject(array $data = []): MediaImage
    {
        return MediaImage::fromArray(self::dataWithOverride($data));
    }
}
