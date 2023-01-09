<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image\ImageDataFactory;

final class FacebookAiMultiAdVariantData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'texts' => [
                    'text1',
                    'text2',
                ],
                'headings' => [
                    'heading1',
                    'heading2',
                ],
                'descriptions' => [
                    'description1',
                    'description2',
                ],
                'images' => [ImageDataFactory::dataWithOverride()],
                'videos' => [],
            ],
            $data
        );
    }

    public static function createObject(array $data = []): FacebookAiMultiAdVariant
    {
        return FacebookAiMultiAdVariant::fromArray(self::dataWithOverride($data));
    }
}
