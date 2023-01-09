<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image;

use CCT\SDK\Campaign\Data\AdContent\Image\Image;

final class ImageDataFactory
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'image_url' => 'https://example.com/image.jpg',
                'uuid' => '03edfa08-7aa3-413e-a83b-4fa6b0e63857',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): Image
    {
        return Image::fromArray(self::dataWithOverride($data));
    }
}
