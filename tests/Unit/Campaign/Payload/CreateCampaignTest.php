<?php

namespace CCT\SDK\Tests\Unit\Campaign\Payload;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\Campaign\Payload\CreateCampaign;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdContentAdData;
use CCT\SDK\Tests\Unit\Campaign\Data\Details\DetailsData;
use CCT\SDK\Tests\Unit\Campaign\Data\Targeting\TargetingData;
use PHPUnit\Framework\TestCase;

class CreateCampaignTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'campaign_flow_uuid' => '60fb0952-2ca4-4e21-9be2-14664f1dfa72',
            'details' => DetailsData::dataWithOverride(),
            'ad_content' => AdContentAdData::dataWithOverride(),
            'targeting' => TargetingData::dataWithOverride(),
        ];

        $createCampaign = CreateCampaign::fromArray($data);

        $this->assertInstanceOf(CreateCampaign::class, $createCampaign);
        $this->assertInstanceOf(CampaignFlowId::class, $createCampaign->campaignFlowUuid);
        $this->assertEquals('60fb0952-2ca4-4e21-9be2-14664f1dfa72', $createCampaign->campaignFlowUuid->toString());
        $this->assertInstanceOf(Details::class, $createCampaign->details);
        $this->assertInstanceOf(AdContent::class, $createCampaign->adContent);
        $this->assertInstanceOf(Targeting::class, $createCampaign->targeting);
    }

    public function testToArray(): void
    {
        $data = [
            'campaign_flow_uuid' => '60fb0952-2ca4-4e21-9be2-14664f1dfa72',
            'details' => DetailsData::dataWithOverride(),
            'ad_content' => AdContentAdData::dataWithOverride(),
            'targeting' => TargetingData::dataWithOverride(),
        ];

        $createCampaign = CreateCampaign::fromArray($data);

        $this->assertEquals($data, $createCampaign->toArray());
    }
}
