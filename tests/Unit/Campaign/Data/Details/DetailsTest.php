<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Details;

use CCT\SDK\Campaign\Data\Details\CampaignPeriod;
use CCT\SDK\Campaign\Data\Details\CampaignTitle;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Details\LandingPage;
use PHPUnit\Framework\TestCase;

class DetailsTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = DetailsData::dataWithOverride();

        $details = Details::fromArray($data);

        $this->assertInstanceOf(CampaignTitle::class, $details->campaignTitle);
        $this->assertEquals('My Campaign', $details->campaignTitle->toString());
        $this->assertInstanceOf(CampaignPeriod::class, $details->campaignPeriod);
        $this->assertInstanceOf(LandingPage::class, $details->landingPage);
        $this->assertEquals('https://example.com', $details->landingPage->toString());
    }

    public function testToArray(): void
    {
        $campaignTitle = new CampaignTitle('My Campaign');
        $campaignPeriod = new CampaignPeriod(new \DateTimeImmutable('2022-01-01'), new \DateTimeImmutable('2022-01-07'));
        $landingPage = new LandingPage('https://example.com');

        $details = new Details($campaignTitle, $campaignPeriod, $landingPage);

        $expected = [
            'campaign_title' => 'My Campaign',
            'campaign_period' => [
                'start_date' => '2022-01-01',
                'end_date' => '2022-01-07',
            ],
            'landing_page' => 'https://example.com',
        ];

        $this->assertEquals($expected, $details->toArray());
    }
}
