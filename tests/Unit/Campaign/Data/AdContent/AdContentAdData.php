<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariantData;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariantData;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdData;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image\ImageDataFactory;

final class AdContentAdData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'campaign_images' => ['user_images_selected' => true, 'channel_images' => [['images' => [ImageDataFactory::dataWithOverride()], '_type' => 'facebook_images']]],
                'campaign_videos' => null,
                'facebook_ai_multi_ad_variants' => [FacebookAiMultiAdVariantData::dataWithOverride()],
                'facebook_carousel_variants' => [],
                'ad_text' => ['enabled' => true],
                'linked_in_ad_variants' => [LinkedInAdData::dataWithOverride()],
                'google_responsive_ad_variants' => [GoogleResponsiveAdVariantData::dataWithOverride()],
                'twitter_ad_variants' => null,
            ],
            $data
        );
    }

    public static function createObject(array $data = []): AdContent
    {
        return AdContent::fromArray(self::dataWithOverride($data));
    }
}
