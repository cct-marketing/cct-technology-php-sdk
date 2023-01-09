<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\LinkedIn;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image\ImageDataFactory;

final class LinkedInAdData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'text' => 'This is some text',
                'images' => [ImageDataFactory::dataWithOverride()],
            ],
            $data
        );
    }

    public static function createObject(array $data = []): LinkedInAdVariant
    {
        return LinkedInAdVariant::fromArray(self::dataWithOverride($data));
    }
}
