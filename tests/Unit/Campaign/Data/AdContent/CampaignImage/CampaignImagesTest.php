<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\CampaignImage;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use PHPUnit\Framework\TestCase;

final class CampaignImagesTest extends TestCase
{
    public function testSerializer(): void
    {
        $dataJson = '{
            "user_images_selected" : true,
            "channel_images": [{
                "images": [{
                    "uuid": "dcec9361-fda8-4ee5-b2f1-9ac96773a89f",
                    "image_url": "https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/dcec9361-fda8-4ee5-b2f1-9ac96773a89f/original.jpg"
                }],
                "_type": "facebook_images"
            },{
                "images": [{
                    "uuid": "dcec9361-fda8-4ee5-b2f1-9ac96773a89f",
                    "image_url": "https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/dcec9361-fda8-4ee5-b2f1-9ac96773a89f/original.jpg"
                }],
                "_type": "google_images"
            }]
        }';

        $data = json_decode($dataJson, true, 512, JSON_THROW_ON_ERROR);

        $campaignImages = CampaignImages::fromArray($data);

        $this->assertEquals($data, $campaignImages->toArray());
    }
}
