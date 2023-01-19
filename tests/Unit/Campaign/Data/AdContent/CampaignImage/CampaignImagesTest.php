<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\CampaignImage;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image\ImageDataFactory;
use PHPUnit\Framework\TestCase;

final class CampaignImagesTest extends TestCase
{
    public function testSerializer(): void
    {
        $data = ['user_images_selected' => true, 'channel_images' => [['images' => [ImageDataFactory::dataWithOverride()], '_type' => 'facebook_images']]];

        $campaignImages = CampaignImages::fromArray($data);

        $this->assertEquals($data, $campaignImages->toArray());
    }
}
