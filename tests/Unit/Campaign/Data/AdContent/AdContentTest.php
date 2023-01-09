<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants;
use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use PHPUnit\Framework\TestCase;

class AdContentTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = AdContentAdData::dataWithOverride();

        $adContent = AdContent::fromArray($data);

        $this->assertInstanceOf(FacebookAiMultiAdVariants::class, $adContent->facebookAiMultiAdVariants);
        $this->assertInstanceOf(GoogleResponsiveAdVariants::class, $adContent->googleResponsiveAdVariants);
        $this->assertInstanceOf(CampaignImages::class, $adContent->campaignImages);
        $this->assertInstanceOf(LinkedInAdVariants::class, $adContent->linkedInAdVariants);
    }

    public function testToArray(): void
    {
        $data = AdContentAdData::dataWithOverride();

        $adContent = AdContent::fromArray($data);

        $this->assertEquals($data, $adContent->toArray());
    }
}
