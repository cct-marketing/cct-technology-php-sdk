<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Payload;

use CCT\SDK\Campaign\Data\CampaignPhase\CampaignPhases;
use CCT\SDK\Campaign\Data\CampaignPhase\OpenHouse;
use CCT\SDK\Campaign\Data\CampaignPhase\Phases;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use PHPUnit\Framework\TestCase;

final class SaveCampaignTest extends TestCase
{
    public function testToArrayWithCampaignPhases(): void
    {
        $payload = new SaveCampaign(
            details: null,
            adContent: null,
            targeting: null,
            options: null,
            campaignPhases: new CampaignPhases(
                Phases::fromItems(new OpenHouse(
                    new \DateTimeImmutable('2019-02-02T16:00:00+00:00'),
                    new \DateTimeImmutable('2019-02-02T18:00:00+00:00')
                ))
            )
        );

        $result = $payload->toArray();

        $this->assertArrayHasKey('campaign_phases', $result);
        $this->assertSame(
            [
                'phases' => [
                    [
                        'start_date' => '2019-02-02T16:00:00+00:00',
                        'end_date' => '2019-02-02T18:00:00+00:00',
                        '_type' => 'open_house',
                    ],
                ],
            ],
            $result['campaign_phases']
        );
    }

    public function testCampaignPhasesIsNullByDefault(): void
    {
        $payload = new SaveCampaign(null, null, null, null);

        $result = $payload->toArray();

        $this->assertArrayHasKey('campaign_phases', $result);
        $this->assertNull($result['campaign_phases']);
    }

    public function testFromArrayHydratesCampaignPhases(): void
    {
        $payload = SaveCampaign::fromArray([
            'details' => null,
            'ad_content' => null,
            'targeting' => null,
            'options' => null,
            'campaign_phases' => [
                'phases' => [
                    [
                        '_type' => 'open_house',
                        'start_date' => '2019-02-02T16:00:00+00:00',
                        'end_date' => '2019-02-02T18:00:00+00:00',
                    ],
                ],
            ],
        ]);

        $this->assertInstanceOf(CampaignPhases::class, $payload->campaignPhases);
        $this->assertCount(1, $payload->campaignPhases->phases);
        $this->assertInstanceOf(OpenHouse::class, $payload->campaignPhases->phases->first());
    }
}
