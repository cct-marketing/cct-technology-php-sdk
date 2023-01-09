<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\MediaManagement\ViewModel;

use CCT\SDK\MediaManagement\ViewModel\BaseMedia;

final class BaseMediaDataFactory
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge([
            'id' => '496aa985-11ad-4b02-b5dc-32a3fd354ad5',
            'name' => 'image1.jpg',
            'description' => 'A test image',
            'private' => true,
            'extension' => 'jpg',
            'status' => 'ready',
            'external' => false,
            'contexts' => [],
            'type' => 'image',
            'endpoint' => 'https://example.com/images/123',
            'file_format' => 'image/jpeg',
            'original_uri' => 'https://example.com/original/123.jpg',
        ], $data);
    }

    public static function createObject(array $data = []): BaseMedia
    {
        return BaseMedia::fromArray(self::dataWithOverride($data));
    }
}
